<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RifasRequest;
use App\modelos\Rifa;
use App\modelos\RifaUsuario;
use Carbon\Carbon;
use App\User;
use Auth;

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
        $rifa->delete();
        
        return \Redirect::back()->with("message",'Rifa eliminada exitósamente');
    }

    public function unirseSorteo()
    {
        
        $rifa = Rifa::all()->last();
        
        if ($rifa==null) {
            return redirect()->action('RifasController@agregarRifa')->with('message','Agregue una rifa primero');
        }
        return \View::make('rifas.unirse-a-sorteo',compact('rifa'));
    }

    public function guardarUnionSorteo(Request $request,$id)
    {

    	$union_sorteo = new RifaUsuario;
        $union_sorteo->rifa_id = $id;
        $union_sorteo->usuario_id = Auth::user()->id;
        $union_sorteo->id_transferencia = $request->id_transferencia;
        $union_sorteo->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $union_sorteo->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $union_sorteo->save();

    	return \View::make('rifas.unirse-a-sorteo',compact('rifa'));
    }

}
