<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Reserve;

class ReserveController extends Controller
{
    public function index()
    {
        $actual_time = time();
        $actual_time = date("H:i:s", $actual_time);
        $actual_day = date('Y-m-d');
        $lessons = Lesson::get();
        $reserves = Reserve::where('user_id', Auth()->user()->id)->get();
        return view('reserves.index', compact('lessons', 'reserves', 'actual_time', 'actual_day'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'lesson_id' => 'required',
                'date' => 'required|after:yesterday',
                'time' => 'required',
                'quantity' => 'required'
            ]);

            $reserve = new Reserve();

            $end_reserve_hour = strtotime ( '+'.$request->quantity.' hour' , strtotime ($request->time) ) ;
            $end_reserve_hour = date('H:i:s', $end_reserve_hour);

            $reserve = [
                'user_id' => Auth()->user()->id,
                'lesson_id' => $request->lesson_id,
                'reserve_date' => $request->date." ".$request->time,
                'quantity' => $request->quantity,
                'end_reserve_hour' => $end_reserve_hour
            ];

            Reserve::create($reserve);

            session()->flash('success', 'Actividad reservada exitosamente.');
            return redirect()->route('reserva.index');

        } catch (Exception $e) {
            session()->flash('danger', $e);
            return redirect()->back()->withInput();
        }
    }
}
