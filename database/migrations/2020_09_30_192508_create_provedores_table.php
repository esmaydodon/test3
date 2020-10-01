<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('provedores', function (Blueprint $table) {
            $table->integer('id')->unsigned();//el id no es imcrementes es el mimo valor  id de tabla personas FK
            $table->string('contacto',50)->nullable();//no obligatorio
            $table->string('telefono_contacto',50)->nullable();//no obligatorio
            //$table->timestamps();
            //relacionamos las tablas
            $table->foreign('id')->references('id')->on('personas')->onDelete('cascade');
        });
    }
  
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provedores');
    }
}
