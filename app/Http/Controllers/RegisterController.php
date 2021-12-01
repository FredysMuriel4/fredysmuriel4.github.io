<?php

namespace App\Http\Controllers;

use App\Mail\verifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'last_name' => 'required',
            'phone' => 'required | unique:users,phone',
            'email' => 'required | unique:users,email',
            'password' => 'required',
            'verify_password' => 'required'
        ]);

        if($request->password != $request->verify_password){
            session()->flash('danger', 'Error. Las contraseñas no coinciden.');
            return redirect()->back()->withInput();
        }

        if(strlen(strval($request->phone)) != 10){
            session()->flash('danger', 'Teléfono diligenciado de manera incorrecta.');
            return redirect()->back()->withInput();
        }

        try {
            $model = new User();
            $model->name = $request->name;
            $model->last_name = $request->last_name;
            $model->phone = $request->phone;
            $model->email = $request->email;
            $model->code = sha1(time());
            $model->password = Hash::make($request->password);
            $model->save();

            $data = [
                'name' => $model->name." ".$model->last_name,
                'code' => $model->code
            ];
            Mail::to($model->email)->send(new verifyEmail($data));

            session()->flash('success', 'Cuenta creada de manera satisfactoria. Por favor, verifica tu correo.');
            return redirect()->route('login');
        } catch (\Exception $e) {
            session()->flash('danger', $e);
            return redirect()->back()->withInput();
        }
    }

    public function verifyEmail($code)
    {
        $user = User::where('code', $code)->first();
        if($user != null){
            $user->code_confirmed = 1;
            $user->save();
            return redirect()->route('login')->with(session()->flash('success', 'Email verificado de manera correcta.'));
        }
        return redirect()->route('login')->with(session()->flash('danger', '¡Código de verificación invalido!'));
    }
}
