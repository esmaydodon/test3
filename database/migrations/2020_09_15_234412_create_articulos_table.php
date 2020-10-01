<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idcategoria')->unsigned();//unsugned para saberque es llave foreana
            $table->string('codigo',50)->nullable();// es un cmapo no obligatorio
            $table->string('nombre',100)->unique();//un campo unico
            $table->decimal('precio_venta',11,2);//dos sifras decimales
            $table->integer('stock');
            $table->string('descripcion',256)->nullable();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            // este campo va ser, hace referencia al compo ide de la tabla categorias
            $table->foreign('idcategoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
