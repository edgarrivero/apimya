<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Http\Requests\ProductoRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produc = Producto::all();
        return response()->json($produc, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoRequest $request)
    {
        try {

            $produc = new Producto($request->all());
            $produc->save();
            return response()->json('Producto Creado', 200);

        }catch (\Exception $ex){
            return response()->json($ex->getMessage(), 402);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return response()->json($producto, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        try {
            Rule::unique('productos')->ignore($producto->nombre);
       
            $producto->cantidad = $request->cantidad;
            $producto->precio = $request->precio;
            $producto->descripcion = $request->descripcion;
            $producto->save();

            return response()->json('Actualizado con exito', 201);
        }catch (\Exception $ex){
            return response()->json(["error"=>$ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        //$todos = Estudiante::all();
        return response()->json('Cliente Eliminado', 201);
    }
}
