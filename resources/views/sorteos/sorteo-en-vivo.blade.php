@extends('layouts.app')

@section('content')
<div class="col-sm-8">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{trans('mensajes.sorteo-en-vivo')}}
                
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
            		<!-- <h2 class="panel-title">
            			{{trans('mensajes.sorteo-en-vivo')}}
            		</h2> -->
            	</div>
            	Aca pondremos pantalla youtube
            	
            </div>
        </div>
    </div>
</div>
@endsection
