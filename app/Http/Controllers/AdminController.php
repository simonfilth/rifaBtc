<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
		return \View::make('admin.dashboard');
    }

    public function mostrarUsuarios(Request $request)
    {
    	$valor = $request->buscar;
    	$usuarios = User::where('name','LIKE',"%$valor%")
    		->orWhere('name','LIKE',"%$valor%")
    		->orWhere('apellido','LIKE',"%$valor%")
    		->orWhere('email','LIKE',"%$valor%")
    		->paginate(15);
    	
    	return \View::make('admin.mostrar-usuarios',compact('usuarios'));
    }

    public function agregarUsuario()
    {
    	$tipo_usuario = array('Administrador','Cliente');
    	return \View::make('admin.agregar-usuario',compact('tipo_usuario'));
    }

    public function guardarUsuario(CreateUserRequest $request)
    {
    	$usuario = new User;
    	$usuario->fill($request->all());
        if($request->tipo_usuario==0){
            $usuario->tipo_usuario = "Administrador";
        }
        else{
            $usuario->tipo_usuario = "Cliente";
        }
        $usuario->password = bcrypt($request->password);
    	$usuario->created_at = Carbon::now()->format('Y-m-d H:i:s');
    	$usuario->updated_at = Carbon::now()->format('Y-m-d H:i:s');
    	$usuario->save();

    	return redirect()->action('AdminController@mostrarUsuarios')->with("message",'Usuario agregado exitósamente');
    }

    public function verUsuario($id)
    {
    	$usuario = User::findOrFail($id);
    	
    	return \View::make('admin.ver-usuario',compact('usuario'));
    }

    public function editarUsuario($id)
    {
        $usuario = User::findOrFail($id);
        $tipo_usuario = array('Administrador','Cliente');
        return \View::make('admin.editar-usuario',compact('usuario','tipo_usuario'));
    }

    public function actualizarUsuario(UpdateUserRequest $request,$id)
    {
    	$usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->apellido = $request->apellido;
        $usuario->email = $request->email;
    	$usuario->id_wallet = $request->id_wallet;
        if($request->tipo_usuario==0){
            $usuario->tipo_usuario = "Administrador";
        }
        else{
            $usuario->tipo_usuario = "Cliente";
        }
        if($request->password != null){
            $usuario->password = bcrypt($request->password);
        }
        $usuario->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $usuario->save();

    	return redirect()->action('AdminController@mostrarUsuarios')->with("message",'Usuario actualizado exitósamente');
    }

    public function eliminarUsuario($id)
    {
    	$usuario = User::findOrFail($id);
        $usuario->delete();
    	
    	return \Redirect::back()->with("message",'Usuario eliminado exitósamente');
    }


}