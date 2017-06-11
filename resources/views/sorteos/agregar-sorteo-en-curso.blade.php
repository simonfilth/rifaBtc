@extends('layouts.app')

@section('content')
<div class="col-sm-8">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{trans('mensajes.sorteo')}}
                <small>{{trans('mensajes.add')}}</small>
            </h1>
            <div class="text-success text-center">
                @if(Session::has('message'))
                    {{Session::get('message')}}
                @endif
            </div> 
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
                    @include('errors.errors')

                    {!! Form::open(['url' =>'guardar-sorteo', 'method' => 'POST']) !!}

	                    <div class="form-group">
						    {!! Form::label('sorteo_id', trans('mensajes.lista-sorteos').':') !!}
						    {!!Form::select('sorteo_id', $sorteos, null, ['class' => 'form-control'])!!}
						</div>
                        
                        <div class="form-group">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection