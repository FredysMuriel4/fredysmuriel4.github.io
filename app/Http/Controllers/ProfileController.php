<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
