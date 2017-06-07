<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RifasRequest;
use App\Http\Requests\TransferenciasRequest;
use App\modelos\Rifa;
use App\modelos\RifaUsuario;
use Carbon\Carbon;
use App\User;
use Auth;
use App\modelos\SorteoEnCurso;

class RifasController extends Controller
{

    public function mostrarRifas(Request $request)
    {
    	$valor = $request->buscar;
    	$rifas = Rifa::where('fecha_rifa','LIKE',"%$valor%")
    		->paginate(15);

    	foreach ($rifas as $rifa) {
    		$input  = $rifa->fecha_rifa;
	        $format = 'Y-m-d';
	        $date = Carbon::createFromFormat($format, $input);
	        $rifa->fecha_rifa =$date->format('d-m-Y');
	        $datos = $rifa->hora_rifa;
            list($h, $m, $s) = explode(":", $datos); 
            $rifa->hora_rifa="$h:$m";
    	}
    	return \View::make('rifas.mostrar-rifas',compact('rifas'));
    }

    public function agregarRifa()
    {
    	return \View::make('rifas.agregar-rifa');
    }

    public function guardarRifa(RifasRequest $request)
    {
    	
    	$input  = $request->fecha_rifa;
        $format = 'd-m-Y';
        $date = Carbon::createFromFormat($format, $input);
        $date=$date->format('Y-m-d');
    	$rifa = new Rifa;
    	$rifa->fill($request->all());
    	$rifa->fecha_rifa = $date;
    	$rifa->created_at = Carbon::now()->format('Y-m-d H:i:s');
    	$rifa->updated_at = Carbon::now()->format('Y-m-d H:i:s');
    	$rifa->save();

    	return redirect()->action('RifasController@mostrarRifas')->with("message",'Rifa agregada exitósamente');
    }

    public function verRifa($id)
    {
    	$rifa = Rifa::findOrFail($id);
    	$input  = $rifa->fecha_rifa;
        $format = 'Y-m-d';
        $date = Carbon::createFromFormat($format, $input);
        $rifa->fecha_rifa =$date->format('d-m-Y');
        $datos = $rifa->hora_rifa;
        list($h, $m, $s) = explode(":", $datos); 
        $rifa->hora_rifa="$h:$m";
        
    	return \View::make('rifas.ver-rifa',compact('rifa'));
    }

    public function editarRifa($id)
    {
        $rifa = Rifa::findOrFail($id);
        $tipo_rifa = array('rifasistrador','Cliente');
        return \View::make('rifas.editar-rifa',compact('rifa','tipo_rifa'));
    }

    public function actualizarRifa(RifasRequest $request,$id)
    {
    	$input  = $request->fecha_rifa;
        $format = 'd-m-Y';
        $date = Carbon::createFromFormat($format, $input);
        $date=$date->format('Y-m-d');
    	$rifa = Rifa::findOrFail($id);
    	$rifa->fill($request->all());
    	$rifa->fecha_rifa = $date;
        $rifa->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $rifa->save();

    	return redirect()->action('RifasController@mostrarRifas')->with("message",'Rifa actualizada exitósamente');
    }

    public function eliminarRifa($id)
    {
        $rifa = Rifa::findOrFail($id);

        $rifas_usuarios = RifaUsuario::where('rifa_id',$rifa->id)->delete();

        $rifa->delete();
        
        return \Redirect::back()->with("message",'Rifa eliminada exitósamente');
    }

    public function unirseSorteo()
    {
        
        $rifa = Rifa::all()->last();
        // dd($rifa);
        if ($rifa==null) {
            if(Auth::user()->tipo_usuario=='Cliente'){
                return redirect()->action('ClientesController@panelCliente')->with('message','No hay sorteos en este momento');
            }
            return redirect()->action('RifasController@agregarRifa')->with('message','Agregue una rifa primero');
        }

        $sorteos = RifaUsuario::where([['rifas_usuarios.rifa_id',$rifa->id],['rifas_usuarios.usuario_id',Auth::user()->id]])
            ->join('rifas','rifas.id','rifas_usuarios.rifa_id')
            ->get();
        // dd($sorteos);
        return \View::make('rifas.unirse-a-sorteo',compact('rifa','sorteos'));
    }

    public function guardarUnionSorteo(TransferenciasRequest $request,$id)
    {

    	$union_sorteo = new RifaUsuario;
        $union_sorteo->rifa_id = $id;
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
            $rifas_usuarios = RifaUsuario::where('rifas_usuarios.rifa_id',$id)
            ->join('users','users.id','rifas_usuarios.usuario_id')
            ->join('rifas','rifas.id','rifas_usuarios.rifa_id')
            ->paginate(15);
            $rifa = Rifa::find($id);
        }
        else{
            $rifa = Rifa::all()->last();
            if ($rifa==null) {
                if(Auth::user()->tipo_usuario=='Cliente'){
                    return redirect()->action('ClientesController@panelCliente')->with('message','No hay sorteos en este momento');
                }
            }
            $rifas_usuarios = RifaUsuario::where('rifas_usuarios.rifa_id',$rifa->id)
            ->join('users','users.id','rifas_usuarios.usuario_id')
            ->join('rifas','rifas.id','rifas_usuarios.rifa_id')
            ->paginate(15);
        }
        
        return \View::make('rifas.mostrar-participantes',compact('rifas_usuarios','rifa'));
    }

    public function confirmarPago($id)
    {
        $rifas_usuarios = RifaUsuario::where('id_transferencia',$id)->first();
        $rifas_usuarios->confirmar_pago = 1;
        $rifas_usuarios->save();
        
        return \Redirect::back()->with("message",'Pago confirmado exitósamente');
    }

    public function agregarSorteo()
    {
        $rifas = Rifa::pluck('fecha_rifa','id')->toArray();
        
        return \View::make('rifas.agregar-sorteo',compact('rifas'));
    }
    public function guardarSorteo(Request $request)
    {
        $sorteo_en_curso = SorteoEnCurso::first();

        if($sorteo_en_curso==null){
            $sorteo_en_curso= new SorteoEnCurso;
            $sorteo_en_curso->created_at = Carbon::now()->format('Y-m-d H:i:s');
        }
        $sorteo_en_curso->rifa_id = $request->rifa_id;
        $sorteo_en_curso->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $sorteo_en_curso->save();
        
        return \Redirect::back()->with("message",'Sorteo agregado exitósamente');
    }

}
