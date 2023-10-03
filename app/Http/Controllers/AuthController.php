<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return "chegamos aqui (login)";
    }

    public function logout()
    {
        return "chegamos aqui (logout)";
    }

    public function refresh()
    {
        return "chegamos aqui (refresh)";
    }

    public function me()
    {
        return "chegamos aqui (me)";
    }
}
