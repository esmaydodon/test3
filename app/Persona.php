<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable=[
        'nombre',
        'tipo_documento',
        'num_documento',
        'direccion',
        'telefono',
        'email'];
        public function provedor(){//una persona eata relacionado con un solo proveedor
            return $this->hasOne('App\Proveedor');//retornamos modelo proveedor
        }    
}
 