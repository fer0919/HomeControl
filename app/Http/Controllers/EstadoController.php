<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\Estado;
use Log;

class EstadoController extends Controller
{
    public function Get(){
        $estados = Estado::all();
        return $estados;
    }

    public function Post(Request $request)
    {
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'estado' => 'required|string|max:255',            
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
        }

        $estados = Estado::create([
            'estado' => $request->get('estado'),
        ]);

        $estados->save();
        return $estados;
    }

    public function Put(int $id, Request $request){
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'estado' => 'required|string|max:255',
            
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
        }

        $estados = Estado::find($id);
        $estados->estado = $request->get('estado');
        $estados->save();
        return Estado::all();
    }

    public function Delete(int $id){
        $estados = Estado::find($id);
        $estados->delete();
        return Estado::all();
    }
}
