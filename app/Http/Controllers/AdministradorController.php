<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        return view('home');
    }
}
