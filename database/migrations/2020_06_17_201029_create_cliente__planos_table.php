<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientePlanosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_planos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('cliente_id');
            $table->integer('plano_id');

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('plano_id')->references('id')->on('planos');
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
        Schema::dropIfExists('cliente_planos');
    }
}
