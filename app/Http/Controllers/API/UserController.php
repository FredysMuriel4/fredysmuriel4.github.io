<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    use HasApiTokens;

    public function login(Request $request)
    {
        try {
            $Validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required',
            ]);

            if ($Validator->fails()) {
                return  response()->json([
                    'status' => 500,
                    'message' => $Validator->errors()->first(),
                    'data' => $Validator->errors()
                ]);
            }

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return  response()->json([
                    'status' => 401,
                    'message' => 'Credenciales incorrectas',
                    'data' => null
                ]);
            }

            if(Auth::user()->code_confirmed == 0) {
                return  response()->json([
                    'status' => 401,
                    'message' => 'Su cuenta no ha sido activada.',
                    'data' => null,
                    // 'user' => Auth::user()
                ]);
            }

            $token = Auth::user()->createToken('authToken')->plainTextToken;

            return  response()->json([
                'status' => 200,
                'message' => 'Sesión iniciada',
                'data' => $token,
                // 'user' => Auth::user()
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function profile()
    {
        try {
            $user = Auth::user();

            return response()->json([
                'status' => 200,
                'data' => $user,
                'message' => 'Información del usuario.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => null
            ]);
        }
    }

    public function logOut()
    {
        try {

            Auth::user()->tokens()->delete();

            return response()->json([
                'status' => 200,
                'data' => null,
                'message' => 'Ha finalizado su sesión.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => null
            ]);
        }
    }
}

