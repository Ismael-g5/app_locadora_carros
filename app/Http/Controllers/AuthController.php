<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
     //autenticação email e senha, no metodo all podemos retornar um array
     $credenciais =  $request->all(['email', 'password']);

        $token = auth('api')->attempt($credenciais);
        if($token){
            return response()->json(['token' => $token]);
        }else{
            return response()->json(['error' => 'Usuario ou Senha invalido'], 403);
        }

    }

    public function logout()
    {
        auth('api')->logout(); // o proprio metodo logout joga o token para a blacklist
        return response()->json(['message' => 'Logout realizado com sucesso'], 200);
    }

    public function refresh()
    {
        $token = auth('api')->refresh();

        return response()->json(['token' => $token]);
            // o refresh retornara um novo token e jogara o antigo para a blacklist
    }

    public function me()
    {
       return response()->json(auth()->user());
    }
}
