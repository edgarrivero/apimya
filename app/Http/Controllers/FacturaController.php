<?php

namespace App\Http\Controllers;

use App\Factura;
use App\Http\Requests\FacturaRequest;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facturas = Factura::all();
        return response()->json($facturas, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacturaRequest $request)
    {
        $clien = DB::table('clientes')->where('id', $request->cliente_id)->exists();
        try {
            if (!$clien) {
                return response()->json('Ese cliente no existe', 422);
            }

            $factura = new Factura($request->all());
            $factura->save();
            return response()->json('Factura Creada', 200);

        }catch (\Exception $ex){
            return response()->json($ex->getMessage(), 402);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        return response()->json($factura, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        try {
            Rule::unique('facturas')->ignore($cuenta->num_factura);
            $factura->pago = $request->pago;
            $factura->save();

            return response()->json('Actualizado con exito', 201);
        }catch (\Exception $ex){
            return response()->json(["error"=>$ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        $factura->delete();
        //$todos = Estudiante::all();
        return response()->json('Registro Eliminado exitosamente', 201);
    }
}
