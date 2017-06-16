@extends('layouts.app')

@section('content')
<div class="col-sm-8">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{trans('mensajes.premios')}}
                
            </h1>
            <div class="text-success text-center">
                @if(Session::has('message'))
                    {{Session::get('message')}}
                @endif
            </div> 
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
            	<div class="panel-heading">
            		<h2 class="panel-title">
            			
            		</h2>
            		
            	</div>
                <div class="panel-body">
                    {!! Html::image('imagenes/premio-acumulado.jpeg', 'Imagen', array('class' => 'img-responsive')) !!}
                    <p class="total-acumulado">
                        {{trans('mensajes.total')}} {{trans('mensajes.acumulado')}}<br>
                        {{$total}} <i class="fa fa-btc"></i>
                    </p>
                </div>
            	
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-yellow">
            	<div class="panel-heading">
            		<h2 class="panel-title">
            			{{trans('mensajes.primero')}}
            		</h2>
            		{{$primero}}
            	</div>
            	
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-primary">
            	<div class="panel-heading">
            		<h2 class="panel-title">
            			{{trans('mensajes.segundo')}}
            		</h2>
            		{{$segundo}}
            	</div>
            	
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-red">
            	<div class="panel-heading">
            		<h2 class="panel-title">
            			{{trans('mensajes.tercero')}}
            		</h2>
            		{{$tercero}}
            	</div>
            	
            </div>
        </div>
    </div>
</div>
@endsection
