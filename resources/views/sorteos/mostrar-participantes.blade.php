@extends('layouts.app')

@section('content')
<div class="col-sm-8">
	<div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">{{trans('mensajes.participantes')}}</h1>
        		<!-- <h3>Datos de sorteo</h3> -->
                @if($sorteo->fecha_sorteo!=null)
                    <p>Fecha: {!!$sorteo->fecha_sorteo!!}</p>
                @endif
                @if($sorteo->fecha_sorteo!=null)
                    <p>Hora: {!!$sorteo->hora_sorteo!!}</p>
                @endif
                <p><i class="fa fa-money"></i> {{trans('mensajes.premio')}}: {{$premio_total}}  <i class="fa fa-btc"></i> </p>
	            

            
            <!-- <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol> -->
        </div>
    </div>
    <br>
    <div class="row">
        <div class="panel">
            <div class="text-success text-center">
                @if(Session::has('message'))
                    {{Session::get('message')}}
                @endif
            </div>               
            <div class="panel-body">

                <!-- {!! Form::open(['action' =>'SorteosController@mostrarParticipantes', 'method' => 'GET','role'=>'search']) !!}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="input-group">
                              <input type="text" name="buscar" class="form-control" placeholder="Buscar participante...">
                              <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                              </span>
                            </div>
                            <br> 
                        </div>
 
                    </div>                  
                </div>
                {!! Form::close() !!}    -->   
                <!-- <div class="row"> -->
        			<!-- <div class="col-lg-6"> -->
		                <table id="table-responsive" class="table table-condensed table-striped sortable ">
		                    <thead>
                                <th>#</th>
		                        <th>{{trans('mensajes.name')}}</th>
		                        <th>{{trans('mensajes.last-name')}}</th>
		                        @if(Auth::user()->tipo_usuario == 'Administrador')
		                        <th>{{trans('mensajes.id-transferencia')}}</th>
		                        <th>{{trans('mensajes.confirmar-pago')}}</th>
		                        @endif
		                    </thead>
		                    <tbody>
		                        @forelse($sorteos_usuarios as $i => $sorteo)
		                        <tr>
                                    <td>{!!$i+1!!}</td>
		                            <td>{!!$sorteo->name!!}</td>
		                            <td>{!!$sorteo->apellido!!}</td>
		                        @if(Auth::user()->tipo_usuario == 'Administrador')
		                            <td>{!!$sorteo->id_transferencia!!}</td>
		                            @if($sorteo->confirmar_pago == 0)
		                            	<td><a class="btn btn-primary" href="{{url('confirmar-pago',$sorteo->id_transferencia)}}">{{trans('mensajes.confirmar-pago')}}</a></td>
		                            @elseif($sorteo->confirmar_pago == 1)
		                            	<td><p class="text-success"><i class="fa fa-check"></i> {{trans('mensajes.pago-confirmado')}}</p></td>
		                            @endif
		                        @endif
		                        </tr>
		                        @empty
		                        	<tr><td align="center" colspan="4">{{trans('mensajes.no-resultados')}}</td></tr>
		                        @endforelse
		                    </tbody>
		                </table>
                	<!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
        {!!$sorteos_usuarios->appends(Request::all())->render()!!} 
    </div>
</div>
@endsection