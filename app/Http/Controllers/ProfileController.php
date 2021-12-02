<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function updatePic(Request $request)
    {
        $request->validate([
            'photo' => 'required | mimes:jpg,jpeg,png'
        ]);
        $p_photo = NULL;
        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $p_photo = time().'-'.$photo->getClientOriginalName();
            \Storage::disk('public')->put($p_photo,  \File::get($photo));
        }
        $model = User::find(Auth()->user()->id);
        $model->profile_picture = $p_photo;
        $model->save();
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'verify_password' => 'required'
        ]);

        if($request->password != $request->verify_password){
            session()->flash('danger', 'Las contraseñas no coinciden');
            return redirect()->back()->withInput();
        }

        $model = User::find(Auth()->user()->id);
        $model->password = Hash::make($request->password);
        $model->save();
        session()->flash('success', 'Contraseña actualizada de forma correcta.');
        return redirect()->back()->withInput();
    }
}
