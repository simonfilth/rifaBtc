@extends('layouts.app')

@section('content')
<div class="col-sm-8">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                rifa
                <small>{{$rifa->fecha_rifa}}</small>
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
                    <p><i class="fa fa-calendar"></i> {{$rifa->fecha_rifa}}</p>
                    <p><i class="fa fa-clock-o"></i> {{$rifa->hora_rifa}}</p>
                    <p><i class="fa fa-money"></i> {{$rifa->precio_rifa}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection