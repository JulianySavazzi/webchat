<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    //listagem de usuarios
    public function index()
    {
        //pegar todos os usuarios do BD
        $users = User::all();
        
        return response()->json([
            'users' => $users
        ], Response::HTTP_OK);
    }
}
