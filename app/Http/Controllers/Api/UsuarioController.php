<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return response()->json(Usuario::with('rol')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_rol' => 'required|exists:roles,id_rol',
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|max:100|unique:usuarios,correo',
            'contrasena' => 'required|string|min:6',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        $usuario = Usuario::create([
            'id_rol' => $data['id_rol'],
            'nombre' => $data['nombre'],
            'correo' => $data['correo'],
            'contrasena_hash' => Hash::make($data['contrasena']),
            'telefono' => $data['telefono'] ?? null,
            'direccion' => $data['direccion'] ?? null,
        ]);

        return response()->json($usuario->load('rol'), 201);
    }

    public function show($id)
    {
        return response()->json(Usuario::with('rol')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $data = $request->validate([
            'id_rol' => 'sometimes|exists:roles,id_rol',
            'nombre' => 'sometimes|string|max:100',
            'correo' => 'sometimes|email|max:100|unique:usuarios,correo,' . $usuario->id_usuario . ',id_usuario',
            'contrasena' => 'nullable|string|min:6',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        if (!empty($data['contrasena'])) {
            $data['contrasena_hash'] = Hash::make($data['contrasena']);
            unset($data['contrasena']);
        }

        $usuario->update($data);

        return response()->json($usuario->load('rol'));
    }

    public function destroy($id)
    {
        Usuario::findOrFail($id)->delete();

        return response()->json(['message' => 'Usuario eliminado']);
    }
}