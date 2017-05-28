@extends('layouts.app')

@section('content')
<div class="col-sm-8">
	<div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Rifas</h1>
        	

            
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

                {!! Form::open(['action' =>'RifasController@mostrarRifas', 'method' => 'GET','role'=>'search']) !!}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="input-group">
                              <input type="text" name="buscar" class="form-control" placeholder="Buscar rifa...">
                              <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                              </span>
                            </div>
                            <br> 
                        </div>
                        <div class="col-sm-3">
                            <a href="{{url('agregar-rifa')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Nueva rifa</a>
                        </div>
 
                    </div>                  
                </div>
                {!! Form::close() !!}      
                
                <table id="table-responsive" class="table table-condensed table-striped sortable ">
                    <thead>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Precio</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        @forelse($rifas as $rifa)
                        <tr>
                            <td>{!!$rifa->fecha_rifa!!}</td>
                            <td>{!!$rifa->hora_rifa!!}</td>
                            <td>{!!$rifa->precio_rifa!!}</td>
                           
                            <td>
                                <a  class="btn btn-primary btn-xs" href="{{ url('mostrar-participantes', $rifa->id)}}" ><i class="fa fa-users"></i> Participantes</a>
                                <a  class="btn btn-primary btn-xs" href="{{ url('ver-rifa', $rifa->id)}}" ><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary btn-xs" href="{{ url('editar-rifa', $rifa->id)}}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-primary btn-xs" href="{{ url('eliminar-rifa', $rifa->id)}}" onclick="return confirm('¿Seguro que desea eliminar esta rifa?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @empty
                        	<tr><td align="center" colspan="4">No se encontraron resultados</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {!!$rifas->appends(Request::all())->render()!!} 
    </div>
</div>
@endsection