<?php

namespace App\Http\Controllers;

use App\Cuenta;
use DB;
use App\Http\Requests\CuentaRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = Cuenta::all();
        return response()->json($cuentas, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CuentaRequest $request)
    {
        $clien = DB::table('clientes')->where('id', $request->cliente_id)->exists();
        try {
            if (!$clien) {
                return response()->json('Ese cliente no existe', 422);
            }

            $cuentas = new Cuenta($request->all());
            $cuentas->save();
            return response()->json($cuentas, 200);

        }catch (\Exception $ex){
            return response()->json($ex->getMessage(), 402);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function show(Cuenta $cuenta)
    {
        return response()->json($cuenta, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuenta $cuenta)
    {
        try {
            Rule::unique('cuentas')->ignore($cuenta->num_cuenta);
            
            $cuenta->num_tarjeta = $request->num_tarjeta;
            $cuenta->banco = $request->banco;
            $cuenta->tipo_cuenta = $request->tipo_cuenta;
            $cuenta->num_seguridad = $request->num_seguridad;
            $cuenta->fecha_vencimiento = $request->fecha_vencimiento;
            $cuenta->user_internet = $request->user_internet;
            $cuenta->pass_internet = $request->pass_internet;
            $cuenta->clave_especial = $request->clave_especial;
            $cuenta->clave_telefonica = $request->clave_telefonica;
            $cuenta->num_cheque = $request->num_cheque;
            $cuenta->clave_cajero = $request->clave_cajero;
            $cuenta->pregunta_seguridad = $request->pregunta_seguridad;
            $cuenta->respuesta_seguridad = $request->respuesta_seguridad;
            $cuenta->save();

            return response()->json('Actualizado con exito', 201);
        }catch (\Exception $ex){
            return response()->json(["error"=>$ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuenta $cuenta)
    {
        $cuenta->delete();
        //$todos = Estudiante::all();
        return response()->json('Registro Eliminado exitosamente', 201);
    }
}
