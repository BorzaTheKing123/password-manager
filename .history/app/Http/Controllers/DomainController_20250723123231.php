<?php

namespace App\Http\Controllers;

use App\Features\GeneratePasswordFeature;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function get(Request $request) {
        $gnp = new GeneratePasswordFeature;
        return view('home', ["password" => $gnp->handle($request->domain, $request->salt, $request->num)]);
    }
}
