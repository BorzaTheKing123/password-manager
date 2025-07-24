<?php

namespace App\Http\Controllers;

use App\Features\GeneratePasswordFeature;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function get(Request $request) {
        return view('home', ["password" => new GeneratePasswordFeature($request->domain, $request->salt, $request->num)->handle()]);
    }
}
