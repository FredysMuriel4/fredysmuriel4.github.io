<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserve;
use Auth;
use Illuminate\Support\Facades\Validator;

class ReserveController extends Controller
{
    public function index(Request $request)
    {
        try {

            $reserves = Reserve::where('user_id', Auth::user()->id)
                ->with('getLesson:id,name')
                ->select('start_date', 'end_date', 'start_time', 'end_time', 'lesson_id', 'state')
                ->get();

            if(isset($reserves)) {
                return response()->json([
                    'status' => 200,
                    'data' => $reserves,
                    'message' => 'Reservas del usuario'
                ]);
            }

            return response()->json([
                'status' => 200,
                'data' => [],
                'message' => 'Sin reservas'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function store(Request $request)
    {
        try {

            $Validator = Validator::make($request->all(), [
                'lesson_id' => 'required',
                'start_date' => 'required|after:yesterday',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);

            if ($Validator->fails()) {
                return  response()->json([
                    'status' => 500,
                    'data' => null,
                    'error' => $Validator->errors(),
                    'message' => $Validator->errors()->first(),
                ]);
            }

            $validate_times = $this->validateReserveTimes($request->start_time, $request->end_time, $request->start_date, $request->lesson_id);
            if(!$validate_times){
                return response()->json([
                    'status' => 500,
                    'data' => null,
                    'error' => 'Error. La actividad ya se encuentra registrada en este lapsus de tiempo.',
                    'message' => 'Error. La actividad ya se encuentra registrada en este lapsus de tiempo.'
                ]);
            }

            // return ;

            $reserve = new Reserve();

            $reserve->user_id = Auth()->user()->id;
            $reserve->lesson_id = $request->lesson_id;
            $reserve->start_date = date('Y-m-d', strtotime($request->start_date));
            if(date('H:i:s', strtotime('+2 hour' ,strtotime(date('H:i:s', strtotime($request->start_time))))) < date('H:i:s', strtotime($request->start_time))) {
                $reserve->end_date = date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d', strtotime($request->start_date)))));
            } else {
                $reserve->end_date = date('Y-m-d', strtotime($request->start_date));
            }
            $reserve->start_time = date('H:i:s', strtotime($request->start_time));
            $reserve->end_time = date('H:i:s', strtotime($request->end_time));
            $reserve->state = 1;

            $reserve->save();

            return response()->json([
                'status' => 201,
                'data' => $reserve,
                'error' => null,
                'message' => 'Reserva generada de manera correcta',
            ]);


        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'data' => null,
                'error' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getReserves($id)
    {
        return Reserve::where('lesson_id', $id)->with('getLesson')->get();
    }

    public function validateReserveTimes($start_time, $end_time, $date, $lesson_id)
    {
        $reserves_by_lesson = $this->getReserves($lesson_id);
        $reserves_by_day = $reserves_by_lesson->where('start_date', $date);

        foreach ($reserves_by_day as $key) {
            if((strtotime($start_time) > strtotime($key->start_time)) && (strtotime($start_time) < strtotime($key->end_time))){
                return false;
            }
            if((strtotime($end_time) > strtotime($key->start_time)) && (strtotime($end_time) < strtotime($key->end_time))){
                return false;
            }
        }
        return true;
    }
}
