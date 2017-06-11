@extends('layouts.app')

@section('content')
<div class="col-sm-8">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{trans('mensajes.sorteo')}}
                <small>{{$sorteo->fecha_sorteo}}</small>
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
                    <p><i class="fa fa-calendar"></i> {{$sorteo->fecha_sorteo}}</p>
                    <p><i class="fa fa-clock-o"></i> {{$sorteo->hora_sorteo}}</p>
                    <p><i class="fa fa-money"></i> {{$sorteo->precio_sorteo}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection