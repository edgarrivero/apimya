<?php

namespace App\Http\Controllers;


use App\Cliente;
use App\Http\Requests\ClienteRequest;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        try {

            $cliente = new Cliente($request->all());
            $cliente->save();
            return response()->json($cliente, 200);

        }catch (\Exception $ex){
            return response()->json($ex->getMessage(), 402);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return response()->json($cliente, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        try {
            Rule::unique('clientes')->ignore($cuenta->cedula);
            $cliente->nombre = $request->nombre;
            $cliente->tlf = $request->tlf;
            $cliente->tlf2 = $request->tlf2;
            $cliente->tlf_pago_movil = $request->tlf_pago_movil;
            $cliente->correo = $request->correo;
            $cliente->pass_correo = $request->pass_correo;
            $cliente->save();

            return response()->json('Actualizado con exito', 201);
        }catch (\Exception $ex){
            return response()->json(["error"=>$ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        //$todos = Estudiante::all();
        return response()->json('Cliente Eliminado', 201);
    }
}
