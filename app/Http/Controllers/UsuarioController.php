<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('index', [
            'usuarios' => $usuarios
        ]);
    }


    public function store()
    {
        $usuario = request()->validate([
            'apodo' => 'required',
            'contrasenha' => 'required'
        ]);

        $newUsuario = Usuario::create($usuario);

        return response()->json(['message' => 'Usuario creado exitosamente!', 'usuario' => $newUsuario]);
    }

    public function update(Request $request, Usuario $usuario)
    {

        $request->validate([
            'apodo' => 'required',
            'contrasenha' => 'nullable',
        ]);


        $usuario->apodo = $request->input('apodo');

        //si se pasa una contraseña, actualizarla...
        if ($request->filled('contrasenha')) {
            $usuario->contrasenha = Hash::make($request->input('contrasenha'));
        }

        $usuario->save();

        return response()->json(['message' => 'Usuario actualizado exitosamente!', 'usuario' => $usuario]);
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado exitosamente!']);
    }


}
