<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function login(Request $request){
        $result = User::where('email', '=', $request->email)->first();

        return $result;
    }
}
