<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){

        $credenciais = $request->all(['email','password']);
       
         $token = auth('api')->attempt($credenciais);

         if($token){
            return response()->json(['token' =>$token]);

         }else{
            return response()->json(['erro' => 'Usuario ou senha invalida'],403);
         }
      

        return 'login';
    }

    public function logout(){
       auth('api')->logout();
       return response()->json(['mensagem' =>  'Logout realizado com sucesso']);
    }

    public function refresh(){
        $token = auth('api')->refresh();
        return response()->json(['token' =>$token]);
    }

    public function me(){
       return response()->json(auth()->user());
    }
}
