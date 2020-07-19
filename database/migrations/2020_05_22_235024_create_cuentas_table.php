<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();

            $table->string('num_cuenta',30)->unique()->required();
            $table->string('num_tarjeta',30)->unique()->nullable();
            $table->string('banco')->nullable();
            $table->string('tipo_cuenta')->nullable();
            $table->string('num_seguridad')->nullable();
            $table->string('fecha_vencimiento')->nullable();
            $table->string('user_internet')->nullable();
            $table->string('pass_internet')->nullable();
            $table->string('clave_especial')->nullable();
            $table->string('clave_telefonica')->nullable();
            $table->string('num_cheque')->nullable();
            $table->string('clave_cajero')->nullable();
            $table->string('pregunta_seguridad')->nullable();
            $table->string('respuesta_seguridad')->nullable();
            $table->bigInteger('cliente_id')->unsigned()->required();
            
            //relacion con Tabla de clientes
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade');

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
        Schema::dropIfExists('cuentas');
    }
}
