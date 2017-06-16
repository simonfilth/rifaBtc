<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\sorteosRequest;
use App\Http\Requests\TransferenciasRequest;
use App\modelos\Sorteo;
use App\modelos\SorteoUsuario;
use App\modelos\SorteoEnCurso;
use App\modelos\Ganador;
use Carbon\Carbon;
use App\User;
use Auth;


class SorteosController extends Controller
{

    public function mostrarSorteos(Request $request)
    {
    	
        // $valor = $request->buscar;
        // $sorteos = sorteo::where('fecha_sorteo','LIKE',"%$valor%")
    	$sorteos = Sorteo::all();
    	/*foreach ($sorteos as $sorteo) {
    		$input  = $sorteo->fecha_sorteo;
	        $format = 'Y-m-d';
	        $date = Carbon::createFromFormat($format, $input);
	        $sorteo->fecha_sorteo =$date->format('d-m-Y');
	        $datos = $sorteo->hora_sorteo;
            list($h, $m, $s) = explode(":", $datos); 
            $sorteo->hora_sorteo="$h:$m";
    	}*/
        // dd(Sorteo::latest()->paginate(10));
        $dataSorteos = $sorteos->toArray();
        $dataSorteos = json_encode($dataSorteos);
        // dd($dataSorteos);
        return \View::make('sorteos.mostrar-sorteos');
    	// return \View::make('sorteos.mostrar-sorteos',compact('sorteos','dataSorteos'));
    }

    public function cargarSorteos()
    {
        // $sorteos = Sorteo::all()->toArray();
        $sorteos = Sorteo::paginate(10);
        // $sorteos = Sorteo::latest()->paginate(10);
// dd($sorteos);
        $response = [
            'pagination' => [
                'total' => $sorteos->total(),
                'per_page' => $sorteos->perPage(),
                'current_page' => $sorteos->currentPage(),
                'last_page' => $sorteos->lastPage(),
                'from' => $sorteos->firstItem(),
                'to' => $sorteos->lastItem(),
            ],
            'data' => $sorteos,
        ];

        return response()->json($response);
        // return response()->json($sorteos);
    }

    public function cargarSorteoEnCurso()
    {
        // $sorteos = Sorteo::all()->toArray();
        $sorteo_en_curso = SorteoEnCurso::first();
        // $sorteos = Sorteo::latest()->paginate(10);
// dd($sorteos);
        $response = [
            'data' => $sorteo_en_curso,
        ];

        return response()->json($response);
        // return response()->json($sorteos);
    }

    public function agregarSorteo()
    {
    	return \View::make('sorteos.agregar-sorteo');
    }

    public function guardarSorteo(SorteosRequest $request)
    {
    	
    	// $input  = $request->fecha_sorteo;
        // $format = 'd-m-Y';
        // $date = Carbon::createFromFormat($format, $input);
        // $date=$date->format('Y-m-d');
    	$sorteo = new Sorteo;
    	$sorteo->fill($request->all());
    	// $sorteo->fecha_sorteo = $date;
    	$sorteo->created_at = Carbon::now()->format('Y-m-d H:i:s');
    	$sorteo->updated_at = Carbon::now()->format('Y-m-d H:i:s');
    	$sorteo->save();

    	return redirect()->action('SorteosController@mostrarSorteos')->with("message",'sorteo agregada exitósamente');
    }

    public function verSorteo($id)
    {
    	$sorteo = Sorteo::findOrFail($id);
    	/*$input  = $sorteo->fecha_sorteo;
        $format = 'Y-m-d';
        $date = Carbon::createFromFormat($format, $input);
        $sorteo->fecha_sorteo =$date->format('d-m-Y');
        $datos = $sorteo->hora_sorteo;
        list($h, $m, $s) = explode(":", $datos); 
        $sorteo->hora_sorteo="$h:$m";*/
        
    	return \View::make('sorteos.ver-sorteo',compact('sorteo'));
    }

    public function editarSorteo($id)
    {
        $sorteo = Sorteo::findOrFail($id);
        $tipo_sorteo = array('sorteosistrador','Cliente');
        return \View::make('sorteos.editar-sorteo',compact('sorteo','tipo_sorteo'));
    }

    public function actualizarsorteo(SorteosRequest $request,$id)
    {
    	$input  = $request->fecha_sorteo;
        $format = 'd-m-Y';
        $date = Carbon::createFromFormat($format, $input);
        $date=$date->format('Y-m-d');
    	$sorteo = Sorteo::findOrFail($id);
    	$sorteo->fill($request->all());
    	$sorteo->fecha_sorteo = $date;
        $sorteo->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $sorteo->save();

    	return redirect()->action('SorteosController@mostrarSorteos')->with("message",'sorteo actualizada exitósamente');
    }

    public function eliminarSorteo($id)
    {
        $sorteo = Sorteo::findOrFail($id);

        $sorteos_usuarios = SorteoUsuario::where('sorteo_id',$sorteo->id)->delete();

        $sorteo->delete();
        
        return \Redirect::back()->with("message",'Sorteo eliminada exitósamente');
    }

    public function unirseSorteo()
    {
        $sorteo_en_curso = SorteoEnCurso::first();
        
        if ($sorteo_en_curso==null) {
            if(Auth::user()->tipo_usuario=='Cliente'){
                return redirect()->action('AdminController@dashboard')->with('message','No hay sorteos en este momento');
            }
            return redirect()->action('SorteosController@agregarSorteo')->with('message','Agregue una sorteo primero');
        }
        $sorteo = Sorteo::where('id',$sorteo_en_curso->sorteo_id)->first();
        $sorteos = SorteoUsuario::where([['sorteos_usuarios.sorteo_id',$sorteo->id],['sorteos_usuarios.usuario_id',Auth::user()->id]])
            ->join('sorteos','sorteos.id','sorteos_usuarios.sorteo_id')
            ->get();
        $precio_por_persona = $sorteo->precio_sorteo/50;

        return \View::make('sorteos.unirse-a-sorteo',compact('sorteo','sorteos','precio_por_persona'));
    }

    public function guardarUnionSorteo(TransferenciasRequest $request,$id)
    {

    	$union_sorteo = new SorteoUsuario;
        $union_sorteo->sorteo_id = $id;
        $union_sorteo->usuario_id = Auth::user()->id;
        $union_sorteo->id_transferencia = $request->id_transferencia;
        $union_sorteo->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $union_sorteo->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $union_sorteo->save();

    	return \Redirect::back()->with("message",'Transferencia agregada exitósamente');
    }

    public function mostrarParticipantes($id=null)
    {
        // dd($id);
        if($id!=null){
            $sorteos_usuarios = SorteoUsuario::where('sorteos_usuarios.sorteo_id',$id)
            ->join('users','users.id','sorteos_usuarios.usuario_id')
            ->join('sorteos','sorteos.id','sorteos_usuarios.sorteo_id')
            ->paginate(15);
            $sorteo = Sorteo::find($id);
        }
        else{
            $sorteo_en_curso = SorteoEnCurso::first();    
            if ($sorteo_en_curso==null) {
                if(Auth::user()->tipo_usuario=='Cliente'){
                    return redirect()->action('ClientesController@panelCliente')->with('message','No hay sorteos en este momento');
                }
            }
            else{
                $sorteo = Sorteo::where('id',$sorteo_en_curso->sorteo_id)->first();
            }
            if (Auth::user()->tipo_usuario=="Administrador") {
                $sorteos_usuarios = SorteoUsuario::where('sorteos_usuarios.sorteo_id',$sorteo->id)
                ->join('users','users.id','sorteos_usuarios.usuario_id')
                ->join('sorteos','sorteos.id','sorteos_usuarios.sorteo_id')
                ->paginate(15);
               
            }
            else{
                $sorteos_usuarios = SorteoUsuario::where([['sorteos_usuarios.sorteo_id',$sorteo->id],['sorteos_usuarios.confirmar_pago',1]])
                ->join('users','users.id','sorteos_usuarios.usuario_id')
                ->join('sorteos','sorteos.id','sorteos_usuarios.sorteo_id')
                ->paginate(15);
            }
        }
        $premio_total = $sorteo->precio_sorteo*0.80;
        return \View::make('sorteos.mostrar-participantes',compact('sorteos_usuarios','sorteo','premio_total'));
    }

    public function confirmarPago($id)
    {

        $sorteos_usuarios = SorteoUsuario::where('id_transferencia',$id)->first();
        $sorteos_usuarios->confirmar_pago = 1;
        $sorteos_usuarios->save();
        
        return \Redirect::back()->with("message",'Pago confirmado exitósamente');
    }

    public function agregarSorteoEnCurso()
    {
        $sorteos = Sorteo::pluck('fecha_sorteo','id')->toArray();
        if(count($sorteos)==0){
            return redirect()->action('SorteosController@agregarSorteo')->with("message",'Debe agregar una sorteo primero');
        }
        return \View::make('sorteos.agregar-sorteo',compact('sorteos'));
    }
    public function comenzarSorteoEnCurso($id)
    {
    // dd("hola");
        $sorteo =  Sorteo::find($id);
        $sorteo->estado_sorteo = "En Curso";
        $sorteo->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $sorteo->save();
        // $sorteo = $id;
        return response()->json($sorteo);
    }

    public function terminarSorteoEnCurso($id)
    {
    // dd("hola");
        $sorteo =  Sorteo::find($id);
        $sorteo->estado_sorteo = "Terminado";
        $sorteo->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $sorteo->save();
        // $sorteo = $id;
        return response()->json($sorteo);
    }

    public function sorteoNoRealizado($id)
    {
    // dd("hola");
        $sorteo =  Sorteo::find($id);
        $sorteo->estado_sorteo = "No realizado";
        $sorteo->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $sorteo->save();
        // $sorteo = $id;
        return response()->json($sorteo);
    }

    public function premios()
    {
        $sorteo_en_curso = SorteoEnCurso::first();
        
        if($sorteo_en_curso==null){
            if(Auth::user()->tipo_usuario=='Cliente'){
                return redirect()->action('AdminController@dashboard')->with("message",'No hay sorteos todavía');
            }
            return redirect()->action('SorteosController@agregarSorteo')->with("message",'Debe agregar un sorteo primero');
        }
        $sorteo = Sorteo::where('id',$sorteo_en_curso->sorteo_id)->first();
        $total = $sorteo->precio_sorteo*0.80;
        $primero = $total*0.60;
        $segundo = $total*0.30;
        $tercero = $total*0.10;
        return \View::make('sorteos.premios',compact('sorteo','primero','segundo','tercero','total'));
    }

    public function sorteoEnVivo()
    {
        
        return \View::make('sorteos.sorteo-en-vivo');
    }

    public function jugarRuleta()
    {
        $jugadores = SorteoEnCurso::join('sorteos_usuarios as SU','SU.sorteo_id','sorteos_en_curso.sorteo_id')
            ->join('users','users.id','SU.usuario_id')
            ->where('SU.confirmar_pago',1)
            ->select('users.name','users.apellido')
            ->get();
        return \View::make('sorteos.jugar-ruleta',compact('jugadores'));
    }

    public function asignarGanadores()
    {
        $sorteo_en_curso = SorteoEnCurso::first();
        if($sorteo_en_curso==null){
            return redirect()->action('SorteosController@mostrarSorteos')->with("message",'Debe activar un sorteo primero');
        }
        $sorteo = Sorteo::where('id',$sorteo_en_curso->sorteo_id)->first();
        $participantes = SorteoUsuario::where([['sorteos_usuarios.sorteo_id',$sorteo->id],['sorteos_usuarios.confirmar_pago',1]])
                ->join('users','users.id','sorteos_usuarios.usuario_id')
                ->join('sorteos','sorteos.id','sorteos_usuarios.sorteo_id')
                ->select('sorteos_usuarios.id as id_su','sorteos_usuarios.*','users.*','sorteos.*')
                ->get();
        $dataParticipantes = $participantes->toArray();
        $dataParticipantes = json_encode($dataParticipantes);
        $consulta_ganadores = Ganador::join('sorteos_usuarios as SU','SU.id','ganadores.sorteo_usuario_id')
            ->where('SU.sorteo_id',$sorteo->id)->get();
        return \View::make('sorteos.asignar-ganadores',compact('sorteo_en_curso','sorteo','participantes','dataParticipantes','consulta_ganadores'));
    }

    public function asignarPremio($sorteo_usuario_id,$lugar)
    {
        $sorteo_en_curso=SorteoEnCurso::first();
        $consulta_ganadores=Ganador::join('sorteos_usuarios as SU','SU.id','ganadores.sorteo_usuario_id')
            ->select('ganadores.*','SU.*','ganadores.id as id_ganador')
            ->where('SU.sorteo_id',$sorteo_en_curso->sorteo_id)->get();
        $si_hay=0;
        $ganador_anterior=null;
        foreach ($consulta_ganadores as $key => $consulta) {
            if($lugar==$consulta->lugar){
                $si_hay=1;
                $ganador_anterior=$consulta;
            }
        }
        if($si_hay==1){
           
            $sorteo_usuario = SorteoUsuario::find($ganador_anterior->sorteo_usuario_id);
            $sorteo_usuario->estado_ganador=0;
            $sorteo_usuario->save();

            $sorteo_usuario = SorteoUsuario::find($sorteo_usuario_id);
            $sorteo_usuario->estado_ganador=1;
            $sorteo_usuario->save();
            $sorteo = Sorteo::find($sorteo_usuario->sorteo_id);
            $pago= $sorteo->precio_sorteo*0.80;
            if($lugar==1){
                $pago = $pago*0.60;
            }
            elseif($lugar==2){
                $pago = $pago*0.30;
            }
            else{
                $pago = $pago*0.10;
            }

            $ganador= Ganador::find($ganador_anterior->id_ganador);
            $ganador->sorteo_usuario_id = $sorteo_usuario_id;
            $ganador->lugar = $lugar;
            $ganador->pago = $pago;
            $ganador->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $ganador->save();

            return \Redirect::back()->with("message",'Premio cambiado exitósamente');
        }
       
        $sorteo_usuario = SorteoUsuario::find($sorteo_usuario_id);
        $sorteo_usuario->estado_ganador=1;
        $sorteo_usuario->save();

        $sorteo = Sorteo::find($sorteo_usuario->sorteo_id);
        $pago= $sorteo->precio_sorteo*0.80;
        if($lugar==1){
            $pago = $pago*0.60;
        }
        elseif($lugar==2){
            $pago = $pago*0.30;
        }
        else{
            $pago = $pago*0.10;
        }
        $ganador = new Ganador;
        $ganador->sorteo_usuario_id = $sorteo_usuario_id;
        $ganador->lugar = $lugar;
        $ganador->pago = $pago;
        $ganador->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $ganador->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $ganador->save();

        // return response()->json($ganador);
        return \Redirect::back()->with("message",'Premio asignado exitósamente');
    }

    public function cambiarPremio($id,$sorteo_usuario_id,$lugar)
    {

        // dd($id);
        $sorteo_en_curso=SorteoEnCurso::first();
        $consulta_ganadores=Ganador::join('sorteos_usuarios as SU','SU.id','ganadores.sorteo_usuario_id')
            ->select('ganadores.*','SU.*','ganadores.id as id_ganador')
            ->where('SU.sorteo_id',$sorteo_en_curso->sorteo_id)->get();
        $si_hay=0;
        $ganador_anterior=null;
        foreach ($consulta_ganadores as $key => $consulta) {
            if($lugar==$consulta->lugar){
                $si_hay=1;
                $ganador_anterior=$consulta;
            }
        }
        if($si_hay==1){
            $borrar_ganador = Ganador::find($ganador_anterior->id_ganador);
            $borrar_ganador->delete();
            $sorteo_usuario = SorteoUsuario::find($ganador_anterior->sorteo_usuario_id);
            $sorteo_usuario->estado_ganador=0;
            $sorteo_usuario->save();
        }
        // dd(Ganador::where('sorteo_usuario_id',$sorteo_usuario_id)->first());
        $ganador = Ganador::where('sorteo_usuario_id',$sorteo_usuario_id)->first();
        $sorteo = Sorteo::join('sorteos_usuarios as SU','SU.sorteo_id','sorteos.id')->where('SU.id',$sorteo_usuario_id)->first();
        $pago= $sorteo->precio_sorteo*0.80;
        if($lugar==1){
            $pago = $pago*0.60;
        }
        elseif($lugar==2){
            $pago = $pago*0.30;
        }
        else{
            $pago = $pago*0.10;
        }
        $sorteo_usuario = SorteoUsuario::find($sorteo_usuario_id);
        $sorteo_usuario->estado_ganador=1;
        $sorteo_usuario->save();

        $ganador->sorteo_usuario_id = $sorteo_usuario_id;
        $ganador->lugar = $lugar;
        $ganador->pago = $pago;
        $ganador->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $ganador->save();

        // return response()->json($ganador);
        return \Redirect::back()->with("message",'Premio cambiado exitósamente');
    }

    public function activarSorteo($id)
    {
        $sorteo_en_curso= SorteoEnCurso::first();
        if($sorteo_en_curso==null){
            $sorteo_en_curso= new SorteoEnCurso;
            $sorteo_en_curso->created_at = Carbon::now()->format('Y-m-d H:i:s');
        }

        $sorteo_en_curso->sorteo_id = $id;
        $sorteo_en_curso->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $sorteo_en_curso->save();
        // $sorteo = $id;
        return response()->json($sorteo_en_curso);
    }
}
