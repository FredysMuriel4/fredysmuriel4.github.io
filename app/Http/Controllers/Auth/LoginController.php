<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username = $this->findUsername() => [
                'required',
                'string',
                Rule::exists('users', $this->username())->where('code_confirmed', 1),
            ],
            'password' => 'required|string',
        ], [
            $this->username() . '.exists' => 'El usuario no esta activo o no sé encuenta registrado'
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        // if($user->role_id == 1){
        //     return redirect()->route('');
        // }else{
        //     return redirect()->route('perfil.edit');
        // }
        return redirect()->route('reserva.index');
    }

    public function findUsername()
    {
        $login = request()->input('email');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : '';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }
}
