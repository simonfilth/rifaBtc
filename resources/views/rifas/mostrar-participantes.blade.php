@extends('layouts.app')

@section('content')
<div class="col-sm-8">
	<div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Participantes</h1>
        		<!-- <h3>Datos de rifa</h3> -->
	        	<p>Fecha: {!!$rifa->fecha_rifa!!}</p>
	            <p>Hora: {!!$rifa->hora_rifa!!}</p>
	            <p>Precio: {!!$rifa->precio_rifa!!}</p>

            
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

                <!-- {!! Form::open(['action' =>'RifasController@mostrarParticipantes', 'method' => 'GET','role'=>'search']) !!}
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
		                        <th>Nombre</th>
		                        <th>Apellido</th>
		                        @if(Auth::user()->tipo_usuario == 'Administrador')
		                        <th>ID Transferencia</th>
		                        <th>Confirmar Pago</th>
		                        @endif
		                    </thead>
		                    <tbody>
		                        @forelse($rifas_usuarios as $rifa)
		                        <tr>
		                            <td>{!!$rifa->name!!}</td>
		                            <td>{!!$rifa->apellido!!}</td>
		                        @if(Auth::user()->tipo_usuario == 'Administrador')
		                            <td>{!!$rifa->id_transferencia!!}</td>
		                            @if($rifa->confirmar_pago == 0)
		                            	<td><a class="btn btn-primary" href="{{url('confirmar-pago',$rifa->id_transferencia)}}">Confirmar pago</a></td>
		                            @elseif($rifa->confirmar_pago == 1)
		                            	<td><p class="text-success"><i class="fa fa-check"></i> Pago confirmado</p></td>
		                            @endif
		                        @endif
		                        </tr>
		                        @empty
		                        	<tr><td align="center" colspan="4">No se encontraron resultados</td></tr>
		                        @endforelse
		                    </tbody>
		                </table>
                	<!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
        {!!$rifas_usuarios->appends(Request::all())->render()!!} 
    </div>
</div>
@endsection