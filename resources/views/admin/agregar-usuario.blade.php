@extends('layouts.app')

@section('content')
<div class="col-sm-8">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{trans('mensajes.usuario')}}
                <small>{{trans('mensajes.add')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-dashboard">                              
                <div class="panel-body">               
                    @include('errors.errors')

                    {!! Form::open(['url' =>'guardar-usuario', 'method' => 'POST']) !!}

                        @include('admin.formulario')
                        <div class="form-group">
                            {!! Form::submit(trans('mensajes.save'), ['class' => 'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection