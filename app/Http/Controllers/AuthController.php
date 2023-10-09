<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function signUp(Request $request){
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            
        ]);
        $token = $user->createToken('authToken')->plainTextToken;

        
        return response()->json([
            'email' => $user->email,
            'token' => $token,
        ], 201); //201 - created
        
            
    }

    public function signIn(Request $request){
        
        
         if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401); // 401 - Unauthorized
        }

        $user = Auth::user();
       
        $token = $user->tokens->first();

        return response()->json([
            'email' => $user->email,
            'token' => $token,
        ], 200); // 200 - OK
    }

    public function logout(Request $request){
        $cookie = Cookie::forget('jwt');

        

        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
    
    public function user(){
        return Auth::user();
    }
}
