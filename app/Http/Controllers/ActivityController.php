<?php

namespace App\Http\Controllers;

use App\Mail\SendLessonCredentials;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('activity.index');
    }

    public function sendCredentials($id)
    {
        try {
            $reserve = Reserve::with('getLesson', 'getUser')->find($id);
            $data = [
                'user_name' => $reserve->getUser->name." ".$reserve->getUser->last_name,
                'lesson' => $reserve->getLesson->name,
                'user' => $reserve->getLesson->user,
                'password' => $reserve->getLesson->password
            ];
            Mail::to($reserve->getUser->email)->send(new SendLessonCredentials($data));
            return json_encode([
                'state' => 200,
                'data' => $reserve,
                'error' => '',
                'message' => 'Las credenciales de acceso han sido enviadas a su correo. Por favor revisar'
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'state' => 500,
                'data' => [],
                'error' => $e->getMessage(),
                'message' => 'Ha ocurrido un error inesperado'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
