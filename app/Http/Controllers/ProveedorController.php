<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Proveedor;
use App\Persona;
class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            //unimos nuestra tabla proveedor con tabla  personas
            $personas = DB::table('provedores')
            ->join('personas','provedores.id','=','personas.id')
            ->select('personas.id','personas.nombre','personas.tipo_documento',
            'personas.num_documento','personas.direccion','personas.telefono','personas.email',
            'provedores.contacto','provedores.telefono_contacto')
            ->orderBy('personas.id','desc')->paginate(3);
        }
        else{
            $personas =Proveedor::join('personas','provedores.id','=','personas.id')
            ->select('personas.id','personas.nombre','personas.tipo_documento',
            'personas.num_documento','personas.direccion','personas.telefono','personas.email',
            'provedores.contacto','provedores.telefono_contacto')
            ->where('personas.'.$criterio, 'like','%'.$buscar.'%')
            ->orderBy('personas.id','desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }   
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        try {
            DB::beginTransaction();    
        $persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->tipo_documento = $request->tipo_documento;
        $persona->num_documento =$request->num_documento;
        $persona->direccion =$request->direccion;
        $persona->telefono =$request->telefono;
        $persona->email =$request->email;
        $persona->save();

        $proveedor = new Proveedor();
        $proveedor->contacto=$request->contacto;
        $proveedor->telefono_contacto=$request->telefono_contacto;
        $proveedor->id=$persona->id;//obtenimos el id de persona para llave foranea personass
        $proveedor->save();
        DB::commit();
        } catch (Exception $e) {
           DB::rollBack();//en caso haya error se desace la transaccion anterior
        }
        //
        
    }
    public function update(Request $request)
    {   if (!$request->ajax()) return redirect('/');
        try {
            DB::beginTransaction();  
              //buacamos el proveedor a modificar
        $proveedor=Proveedor::findOrFail($request->id);      
        $persona = Persona::findOrFail($proveedor->id);

        $persona->nombre = $request->nombre;
        $persona->tipo_documento = $request->tipo_documento;
        $persona->num_documento =$request->num_documento;
        $persona->direccion =$request->direccion;
        $persona->telefono =$request->telefono;
        $persona->email =$request->email;
        $persona->save();

        //$proveedor = new Proveedor();
        $proveedor->contacto=$request->contacto;
        $proveedor->telefono_contacto=$request->telefono_contacto;
        //$proveedor->id=$persona->id;//obtenimos el id de persona para llave foranea personass
        $proveedor->save();
        DB::commit();
        } catch (Exception $e) {
           DB::rollBack();//en caso haya error se desace la transaccion anterior
        }
    }
}
