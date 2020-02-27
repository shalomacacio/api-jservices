<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(!$token = auth('api')->attempt($credentials)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);

    }

    public function me(){
        return response()->json( auth()->user() );
    }

    public function logout(){
        auth()->logout();
        return response()->json(['message'=>'Deslogado']);
    }

    public function refresh(){
        $this->respondWithToken(auth()->refresh());
    }

    public function respondWithToken($token){
        return response()->json([
            'access-token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}
