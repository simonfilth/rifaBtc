@extends('layouts.app')

@section('content')
<div class="col-sm-8">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{trans('mensajes.usuario')}}
                <small>{{$usuario->name}} {{$usuario->apellido}}</small>
            </h1>
            <!-- <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol> -->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">                           
                <div class="panel-body"> 
                    <div class="row">
                        <div class="col-sm-6">
                            <p><i class="fa fa-user"></i> {{$usuario->name}} {{$usuario->apellido}}</p>
                            <p><i class="fa fa-envelope"></i> {{$usuario->email}}</p>
                            <p><i class="fa fa-google-wallet"></i> {{$usuario->id_wallet}}</p>
                            <p><i class="fa fa-users"></i> {{$usuario->tipo_usuario}}</p>
                        </div>
                        <div class="col-sm-6">
                            <a class="btn btn-primary" href="{{ url('editar-usuario', $usuario->id)}}"><i class="fa fa-edit"></i> {{trans('mensajes.edit')}}</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</div>
@endsection