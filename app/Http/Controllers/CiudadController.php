<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\Ciudad;
use Log;

class CiudadController extends Controller
{
    
    public function GetEstaciones_UsuariosId(Request $request){
        $ciudades = Ciudad::select('estados.id', 'estados.estado')
            ->join('estado', 'ciudades.estado_id', '=', 'estados.id')
            ->where('ciudades.estado_id', $request->id)
            ->get();
                                                
        return response()->json(compact('ciudades'));
    }
    
    public function Post(Request $request)
    {
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'ciudad' => 'required|string|max:255',
            'estado_id' => 'required|string|max:255',
            
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
        }

        $ciudades = Ciudad::create([
            'ciudad' => $request->get('ciudad'),
            'estado_id' => $request->get('estado_id'),
        ]);

        $ciudades->save();
        return $ciudades;
    }

    public function Put(int $id, Request $request){
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'ciudad' => 'required|string|max:255',
            'estado_id' => 'required|string|max:255',
            
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
        }

        $ciudades = Ciudad::find($id);
        $ciudades->ciudad = $request->get('ciudad');
        $ciudades->estado_id = $request->get('estado_id');
        $ciudades->save();
        return Ciudad::all();
    }

    public function Delete(int $id){
        $ciudades = Ciudad::find($id);
        $ciudades->delete();
        return Ciudad::all();
    }
}
