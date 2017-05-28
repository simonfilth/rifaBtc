@extends('layouts.app')

@section('content')
<div class="col-sm-8">
	<div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Usuarios</h1>
        	

            
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

                {!! Form::open(['action' =>'AdminController@mostrarUsuarios', 'method' => 'GET','role'=>'search']) !!}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="input-group">
                              <input type="text" name="buscar" class="form-control" placeholder="Buscar usuario...">
                              <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                              </span>
                            </div>
                            <br> 
                        </div>
                        <div class="col-sm-3">
                            <a href="{{url('agregar-usuario')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Nuevo Usuario</a>
                        </div>
 
                    </div>                  
                </div>
                {!! Form::close() !!}      
                
                <table id="table-responsive" class="table table-condensed table-striped sortable ">
                    <thead>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Wallet ID</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $usuario)
                        <tr>
                            <td>{!!$usuario->name!!} {!!$usuario->apellido!!}</td>
                            <td>{!!$usuario->email!!}</td>
                            <td>{!!$usuario->id_wallet!!}</td>
                           
                            <td>
                                <a  class="btn btn-primary btn-xs" href="{{ url('ver-usuario', $usuario->id)}}" ><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary btn-xs" href="{{ url('editar-usuario', $usuario->id)}}"><i class="fa fa-edit"></i></a>
                                @if($usuario->tipo_usuario=='Cliente')
                                <a class="btn btn-primary btn-xs" href="{{ url('eliminar-usuario', $usuario->id)}}" onclick="return confirm('¿Seguro que desea eliminar este usuario?')"><i class="fa fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        	<tr><td align="center" colspan="4">No se encontraron resultados</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {!!$usuarios->appends(Request::all())->render()!!} 
    </div>
</div>
@endsection