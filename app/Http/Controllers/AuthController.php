<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    //
    public function login(){
        //dd(bcrypt('123456'));$2y$10$VieKbG6h/zVaVuZFDHb80.YR8.jsujZbwKWJEfK2v5XbfHkXl8oyS
        return Inertia::render('Login', []);
    }
}
