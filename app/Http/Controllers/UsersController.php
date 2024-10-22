<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        if ($users->isEmpty()) {
            return response()->json([
                'message' => 'No hay Usuarios Registrados',
                'status' => '404'
            ], 404);
        }

        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validador->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validador->errors(),
                'status' => 400
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'user' => $user,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no Encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'user' => $user,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no Encontrado',
                'status' => 404
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'Usuario ' . $id . ' Eliminado',
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no Encontrado',
                'status' => 404
            ], 404);
        }

        $validador = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $id,
            'password' => 'string|min:8|nullable'
        ]);

        if ($validador->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validador->errors(),
                'status' => 400
            ], 400);
        }

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'Usuario ' . $id . ' Actualizado',
            'user' => $user,
            'status' => 200
        ], 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no Encontrado',
                'status' => 404
            ], 404);
        }

        $validador = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $id,
            'password' => 'string|min:8|nullable'
        ]);

        if ($validador->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validador->errors(),
                'status' => 400
            ], 400);
        }

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'Usuario ' . $id . ' Actualizado',
            'user' => $user,
            'status' => 200
        ], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación de datos', 'errors' => $validator->errors()], 400);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json(['message' => 'Usuario existente', 'user' => $user], 200);
        }

        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }
}