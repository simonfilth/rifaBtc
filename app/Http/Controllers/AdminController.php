<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use App\modelos\OtroDatoUsuario;
use App\modelos\Rifa;
use App\modelos\SorteoEnCurso;
use Carbon\Carbon;
use Auth;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $sorteos_vigentes = SorteoEnCurso::first();
        if($sorteos_vigentes==null){
            return \Redirect::back()->with("message",'No hay sorteos');
        }
        $participantes = User::join('rifas_usuarios as RU','RU.usuario_id','users.id')
            ->join('rifas','rifas.id','RU.rifa_id')
            ->where('RU.rifa_id',$sorteos_vigentes->rifa_id)->get();

		return \View::make('admin.dashboard',compact('participantes'));
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
        if(Auth::user()->id == $id or Auth::user()->tipo_usuario == 'Administrador'){
            $usuario = User::where('users.id',$id)
            ->join('otros_datos_usuario as ODU','ODU.usuario_id','users.id')
            ->first();
            // dd($usuario);
            $tipo_usuario = array('Administrador','Cliente');
            return \View::make('admin.editar-usuario',compact('usuario','tipo_usuario'));
        }
        return redirect()->action('HomeController@index');
        
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

    public function guardarFotoUsuario(Request $request,$id)
    {
        $foto_usuario = OtroDatoUsuario::where('usuario_id',$id)->first();
        
        if($request->file('foto_perfil')!=null){
            \Storage::disk('local')->delete($id.'/foto_perfil/'.$foto_usuario->foto_perfil);

            $foto_usuario->foto_perfil=$request->file('foto_perfil')->getClientOriginalName();
            $file = $request->file('foto_perfil');
            $nombre = $id.'/foto_perfil/'.$file->getClientOriginalName();
            
            \Storage::disk('local')->put($nombre,  \File::get($file));
        } 
        $foto_usuario->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $foto_usuario->save();

        if(Auth::user()->tipo_usuario=='Cliente'){
            return \Redirect::back()->with("message",'Foto de perfil agregada exitósamente');
        }
        return redirect()->action('AdminController@mostrarUsuarios')->with("message",'Usuario agregado exitósamente');
    }


}
