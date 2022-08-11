<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Models\Lesson;
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

            return response()->json([
                'status' => 200,
                'data' => $reserves,
                'message' => 'Reservas del usuario'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function getLessons()
    {
        try {

            $lessons = Lesson::get();

            return response()->json([
                'status' => 200,
                'data' => $lessons,
                'message' => 'Actividades creadas'
            ]);


        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
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

            $time_validator = $this->validateHours($request);

            return $time_validator;

            if($time_validator['status'] != 200){
                return $time_validator;
            }

            $lesson = Lesson::where('name', $request->lesson_id)->first();

            $validate_times = $this->validateReserveTimes($request->start_time, $request->end_time, $request->start_date, $lesson->id);
            if(!$validate_times){
                return response()->json([
                    'status' => 500,
                    'data' => null,
                    'error' => 'Error. La actividad ya se encuentra registrada en este lapsus de tiempo.',
                    'message' => 'Error. La actividad ya se encuentra registrada en este lapsus de tiempo.'
                ]);
            }

            if(!isset($lesson)){
                return response()->json([
                    'status' => 500,
                    'data' => null,
                    'error' => 'error',
                    'message' => "No se encontró la actividad",
                ]);
            }

            $reserve = new Reserve();

            $reserve->user_id = Auth()->user()->id;
            $reserve->lesson_id = $lesson->id;
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

    public function validateHours($request)
    {
        if(strtotime(date('H:i:s', strtotime($request->start_time))) > strtotime(date('H:i:s', strtotime($request->end_time)))){
            return response()->json([
                'status' => 500,
                'data' => null,
                'error' => 'Error',
                'message' => 'Error. La hora de inicio no puede ser menor a la hora final'
            ]);
        }

        $start_time = date('H:i:s', strtotime($request->start_time));
        if(strtotime('+2 hours', strtotime($start_time)) > strtotime(date('H:i:s', strtotime($request->end_time)))){
            return response()->json([
                'status' => 500,
                'data' => null,
                'error' => 'Error',
                'message' => 'Error. No puede obtener más de dos horas de reserva'
            ]);
        }

        return return response()->json([
            'status' => 200,
            'data' => null,
            'error' => '',
            'message' => 'Horas correctas'
        ]);
    }
}
