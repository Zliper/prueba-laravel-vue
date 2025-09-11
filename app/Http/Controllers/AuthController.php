<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected array $headers = [
        'Content-Type' => 'application/json'
    ];

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

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Invalid credentials.'
            ], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['token'=>$token, 'user'=>$user]);
    }

    public function logout(Request $request)
    {
        $token = $request->user()?->currentAccessToken();
        if($token){
            $token->delete();
            return response()->json(['message'=>'Logged out'], 200, $this->headers);
        }

        return response()->json(['message'=>'No active token'], 200, $this->headers);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
