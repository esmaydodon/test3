<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',30)->unique();
            $table->string('descripcion',100)->nullable();//permite cmpos nulos
            $table->boolean('condicion')->default(1);
            //$table->timestamps();//por qu los roles osn estaticos
            
        });
        DB::table('roles')->insert(array('id'=>'1','nombre'=>'Administrador','descripcion'=>'Administradores de areas'));
            DB::table('roles')->insert(array('id'=>'2','nombre'=>'Vendedor','descripcion'=>'Vendedor área Venta'));
            DB::table('roles')->insert(array('id'=>'3','nombre'=>'Almacenero','descripcion'=>'Almacenero área Compras'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
