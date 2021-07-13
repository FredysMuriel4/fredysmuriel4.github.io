<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Reserve;

class ReserveController extends Controller
{
    public function index()
    {
        $lessons = Lesson::get();
        $reserves = Reserve::get();
        return view('reserves.index', compact('lessons', 'reserves'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'lesson_id' => 'required',
                'date' => 'required|after:today',
                'time' => 'required',
                'quantity' => 'required'
            ]);

            $reserve = new Reserve();

            $reserve = [
                'user_id' => 1,
                'lesson_id' => $request->lesson_id,
                'reserve_date' => $request->date." ".$request->time,
                'quantity' => $request->quantity
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
