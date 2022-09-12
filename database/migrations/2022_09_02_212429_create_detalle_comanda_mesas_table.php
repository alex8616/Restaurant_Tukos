<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleComandaMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_comanda_mesas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('comanda_mesa_id');
            $table->foreign('comanda_mesa_id')->references('id')->on('comanda_mesas')->onDelete('cascade');
            
            $table->unsignedBigInteger('plato_id');
            $table->foreign('plato_id')->references('id')->on('platos')->onDelete('cascade');

            $table->integer('cantidad');
            $table->decimal('precio_venta');

            $table->string('comentario')->nullable();
            
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
        Schema::dropIfExists('detalle_comanda_mesas');
    }
}
