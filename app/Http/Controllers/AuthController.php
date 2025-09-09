<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $request->password)){
            throw ValidationException::withMessages([
                'email'=> ['Invalid credentials.']
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['token'=>$token, 'user'=>$user]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message'=>'Logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
