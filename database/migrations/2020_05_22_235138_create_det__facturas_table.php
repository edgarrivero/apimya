<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det__facturas', function (Blueprint $table) {
            $table->id();

            $table->string('pago');
            $table->bigInteger('factura_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();
            
            //relacion con Tabla de facturas
            $table->foreign('factura_id')
                ->references('id')
                ->on('facturas');

            //relacion con Tabla de productos
            $table->foreign('producto_id')
                ->references('id')
                ->on('productos');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('det__facturas');
    }
}
