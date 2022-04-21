<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\Casa;
use Log;
class CasaController extends Controller
{
    public function Get(){
        $casas = Casa::all();
        return $casas;
    }
}
