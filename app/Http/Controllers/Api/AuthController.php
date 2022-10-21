<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request){
        $loginData = $request->all();

        $validate = Validator::make($loginData, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if($validate->fails()){
            return response(['message' => 'Harap memasukkan username dan password'], 404);
        }

        if(!Auth::attempt($loginData)){
            return response(['message' => 'Username atau password salah'], 404);
        }

        $user = Auth::user();

        $token = $user->createToken('Authentication Token')->accessToken;

        return response([
            'message' => 'Login successful',
            'user' => $user,
            'access_token' => $token
        ]);

    }

    public function logout(Request $request){
        $request->user()->token()->revoke();

        return response([
            'message' => 'Logged out'
        ]);
    }
}
