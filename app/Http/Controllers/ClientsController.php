<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = Clients::all();
        if ($clients->isEmpty()){
            $data = [
                'message' => 'No hay Clientes Registrados',
                'status' => '404'
            ];
            return response()->json($data, 404);
        }

        return response()->json($clients, 200);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(),[
                'phone' => 'required|digits:9',
                'dni' => 'required|max:8|unique:clientes'
        ]);

        if($validador->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validador->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $clients = Clients::create([
                'phone' => $request->phone,
                'dni' => $request->dni
        ]);

        if(!$clients){
            $data = [
                'message' => 'Error al Crear el Cliente',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'client' => $clients,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $clients = Clients::find($id);

        if(!$clients){
            $data = [
                'message' => 'Cliente no Encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'client' => $clients,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $clients = Clients::find($id);

        if(!$clients){
            $data = [
                'message' => 'Cliente no Encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $clients->delete();
        $data = [
            'message' => 'Cliente '.$id.' Eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $clients = Clients::find($id);

        if(!$clients){
            $data = [
                'message' => 'Cliente no Encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validador = Validator::make($request->all(),[
            'phone' => 'required|digits:9',
            'dni' => 'required|max:8|unique:clientes'
        ]);

        if($validador->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validador->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $clients->phone = $request->phone;
        $clients->dni = $request->dni;

        $clients->save();

        $data = [
            'message' => 'Cliente '.$id.' Actualizado',
            'client' => $clients,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $clients = Clients::find($id);

        if(!$clients){
            $data = [
                'message' => 'Cliente no Encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validador = Validator::make($request->all(),[
            'phone' => 'digits:9',
            'dni' => 'max:8|unique:clientes'
        ]);

        if($validador->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validador->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if($request->has('phone')){
            $clients->phone = $request->phone;
        }

        if($request->has('dni')){
            $clients->dni = $request->dni;
        }

        $clients->save();

        $data = [
            'message' => 'Cliente '.$id.' Actualizado',
            'client' => $clients,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
