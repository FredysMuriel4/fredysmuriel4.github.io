<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;

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
                'start_date' => 'required|after:yesterday',
                'end_date' => 'required|after:yesterday',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);

            $reserve = new Reserve();
            $reserve->user_id = Auth()->user()->id;
            $reserve->lesson_id = $request->lesson_id;
            $reserve->start_date = $request->start_date;
            $reserve->end_date = $request->end_date;
            $reserve->start_time = $request->start_time;
            $reserve->end_time = $request->end_time;
            $reserve->state = 1;

            $reserve->save();

            session()->flash('success', 'Actividad reservada exitosamente.');
            return redirect()->route('reserva.index');

        } catch (\Exception $e) {
            session()->flash('danger', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function create()
    {
        $lessons = Lesson::get();
        return view('reserves.create', compact('lessons'));
    }

    public function getReserves($id)
    {
        return Reserve::where('lesson_id', $id)->with('getLesson')->get();
    }
}
