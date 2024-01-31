<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    //userLogged
    public function me(){
        $userLogged = Auth::user();

        return response()->json([
                    'user' => $userLogged
                ], Response::HTTP_OK);
    }

    //listagem de usuarios
    public function index()
    {
        //controle de sessao
        $userLogged = Auth::user();
        //trazer todos os usuarios, menos o que esta logado
        $users = User::where('id', '!=', $userLogged->getAuthIdentifier())->get();

        //pegar todos os usuarios do BD
//        $users = User::all();

        return response()->json([
            'users' => $users
        ], Response::HTTP_OK);
    }
}
