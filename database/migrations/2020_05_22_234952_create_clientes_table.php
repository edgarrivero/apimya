<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            $table->string('cedula',30)->unique()->required();
            $table->string('nombre')->required();
            $table->string('tlf')->nullable();
            $table->string('tlf2')->nullable();
            $table->string('tlf_pago_movil')->nullable();
            $table->string('correo',30)->unique()->nullable();
            $table->string('pass_correo')->nullable();

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
        Schema::dropIfExists('clientes');
    }
}
