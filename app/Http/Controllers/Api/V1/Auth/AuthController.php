<?php

namespace App\Http\Controllers\Api\V1\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return unauthorized_response("wrong_credentials_message");
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return ok_response(['user' => auth()->user(), 'token' => $token]);

    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);
        auth()->attempt($request->only('email','password'));
        $token = auth()->user()->createToken('API Token')->accessToken;

        return ok_response(['user' => auth()->user(), 'token' => $token]);
    }

}
