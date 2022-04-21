<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo_Usuario;

class Grupos_UsuariosController extends Controller
{
    public function Post(Request $request)
    {
        $grupos_usuarios = Grupo_Usuario::create([
            'fk_grupo' => $request->get('fk_grupo'),
            'fk_usuario' => $request->get('fk_usuario'),
        ]);

        $grupos_usuarios->save();
        return $grupos_usuarios;
    }
}