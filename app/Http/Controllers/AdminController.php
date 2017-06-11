<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use App\modelos\OtroDatoUsuario;
use App\modelos\Sorteo;
use Carbon\Carbon;
use Auth;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $sorteo_en_curso = Sorteo::where('estado_sorteo','En Curso')->first();
        if($sorteo_en_curso==null){
            // return \Redirect::back()->with("message",'No hay sorteos');
            $participantes = [];
            $dataParticipantes = $participantes;
            // dd($participantes);
        }
        else{
            $participantes = User::join('sorteos_usuarios as SU','SU.usuario_id','users.id')
            ->join('sorteos','sorteos.id','SU.sorteo_id')
            ->where('SU.sorteo_id',$sorteo_en_curso->id)->get();
            $dataParticipantes = $participantes->toArray();
 
        }
               
        $dataParticipantes = json_encode($dataParticipantes);

        $ganadores = Sorteo::join('sorteos_usuarios as RU','RU.sorteo_id','sorteos.id')
            ->join('users as U','U.id','RU.usuario_id')
            ->join('premios_primero as PP','PP.usuario_id','U.id')
            ->join('premios_segundo as PS','PS.usuario_id','U.id')
            ->join('premios_tercero as PT','PT.usuario_id','U.id')
            ->get();
        $dataGanadores = $ganadores->toArray();
        $dataGanadores = json_encode($dataGanadores);

        return \View::make('admin.dashboard',compact('participantes','ganadores','dataParticipantes','dataGanadores'));
    }

    public function cargarDatosDashboard()
    {

        $sorteo_en_curso = Sorteo::where('estado_sorteo','En Curso')->first();
        if($sorteo_en_curso==null){
            $participantes = [];
        }
        else{
            $participantes = User::join('sorteos_usuarios as SU','SU.usuario_id','users.id')
            ->join('sorteos','sorteos.id','SU.sorteo_id')
            ->where('SU.sorteo_id',$sorteo_en_curso->id)->get();
        }
               

        $response = [
           /* 'pagination' => [
                'total' => $participantes->total(),
                'per_page' => $participantes->perPage(),
                'current_page' => $participantes->currentPage(),
                'last_page' => $participantes->lastPage(),
                'from' => $participantes->firstItem(),
                'to' => $participantes->lastItem(),
            ],*/
            'data' => $participantes,
        ];

        return response()->json($response);
    }
    public function cargarDatosGanadores()
    {
               

        $ganadores = Sorteo::join('sorteos_usuarios as RU','RU.sorteo_id','sorteos.id')
            ->join('users as U','U.id','RU.usuario_id')
            ->join('premios_primero as PP','PP.usuario_id','U.id')
            ->join('premios_segundo as PS','PS.usuario_id','U.id')
            ->join('premios_tercero as PT','PT.usuario_id','U.id')
            ->get();

        $response = [
            /*'pagination' => [
                'total' => $ganadores->total(),
                'per_page' => $ganadores->perPage(),
                'current_page' => $ganadores->currentPage(),
                'last_page' => $ganadores->lastPage(),
                'from' => $ganadores->firstItem(),
                'to' => $ganadores->lastItem(),
            ],*/
            'data' => $ganadores,
        ];

		return response()->json($response);
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
       
        $contents = \Storage::get('default-profile-pic.png');
        \Storage::put($usuario->id.'/foto_perfil/default-profile-pic.png', $contents);
        $foto_usuario=new OtroDatoUsuario;     
        $foto_usuario->usuario_id = $usuario->id;
        $foto_usuario->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $foto_usuario->updated_at = Carbon::now()->format('Y-m-d H:i:s'); 
        $foto_usuario->foto_perfil="default-profile-pic.png";
        $foto_usuario->save(); 

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
