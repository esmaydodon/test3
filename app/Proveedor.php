<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //como nuestra tabla es proveedores
    //asignamos el plural
    protected $table='provedores';
    protected $fillable = ['id','contacto','telefono_contacto']; 
    public $timestamps = false;
    public function persona(){//unproveedor perecene a una persona
        return $this->belongsTo('App\Persona');//retornamos modelo persona
    } 

}
