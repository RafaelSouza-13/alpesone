<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\AuthException;

class AuthController extends Controller
{
    public function login(SignInRequest $request){    
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
        $token = $user->createToken($user->id.'-'.$user->email)->plainTextToken;
        $data = [
            'message' => 'Usuário autenticado com sucesso',
            'token' => $token,
        ];
        return response()->json($data, 200);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
