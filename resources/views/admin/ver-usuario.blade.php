@extends('layouts.app')

@section('content')
<div class="col-sm-8">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Usuario
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
                    <p><i class="fa fa-user"></i> {{$usuario->name}} {{$usuario->apellido}}</p>
                    <p><i class="fa fa-envelope"></i> {{$usuario->email}}</p>
                    <p><i class="fa fa-google-wallet"></i> {{$usuario->id_wallet}}</p>
                    <p><i class="fa fa-users"></i> {{$usuario->tipo_usuario}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection