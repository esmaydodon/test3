<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }//☻♣☻ validar el inicio de secion del usuario
    public function login(Request $request){
        $this->validateLogin($request);
        if (Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password,'condicion'=>1])) {
            return redirect()->route('main');//si eu usuariose autentico correcto redireccionamos a main
        }
        // return back(); //regresar atras
        return back()
        ->withErrors(['usuario'=>trans('auth.failed')])
        ->withInput(request(['usuario']));//para utilizar en old y regresar a donde avia escrito

    }
    protected function validateLogin(Request $request){
        $this->validate($request,[
            'usuario'=>'required|string',
            'password'=>'required|string'
        ]);
    }
    // para cerrar ceción
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
