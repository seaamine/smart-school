<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    //
    public function login(){
        //dd(Auth::check());
        return Inertia::render('Login', []);
    }
}
