<?php

namespace App\Http\Controllers;

use App\Det_Factura;
use App\Http\Requests\DetFacturaRequest;
use DB;


class DetFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detfactura = Det_Factura::all();
        return response()->json($detfactura, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DetFacturaRequest $request)
    {
        $producto = DB::table('productos')->where('id', $request->producto_id)->exists();
        $factura = DB::table('facturas')->where('id', $request->factura_id)->exists();
        try {
            if (!$producto or !$factura) {
                return response()->json('Ese cliente o factura no existe', 422);
            }

            $det_fac = new Det_Factura($request->all());
            $det_fac->save();
            return response()->json('Detalle de factura Creado', 200);

        }catch (\Exception $ex){
            return response()->json($ex->getMessage(), 402);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Det_Factura  $det_Factura
     * @return \Illuminate\Http\Response
     */
    public function show(Det_Factura $det_Factura)
    {
        return response()->json($det_Factura, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Det_Factura  $det_Factura
     * @return \Illuminate\Http\Response
     */
    public function update(DetFacturaRequest $request, Det_Factura $det_Factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Det_Factura  $det_Factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Det_Factura $det_Factura)
    {
        $det_Factura->delete();
        //$todos = Estudiante::all();
        return response()->json('Registro Eliminado', 201);
    }
}
