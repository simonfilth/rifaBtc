@extends('layouts.app')

@section('content')
<div class="col-sm-8">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{trans('mensajes.sorteo')}}
                <small>{{trans('mensajes.edit')}}</small>
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
            <div class="panel">                           
                <div class="panel-body"> 
                    @include('errors.errors')

                    {!! Form::model($sorteo, ['url' => ['actualizar-sorteo', $sorteo->id], 'method' => 'patch']) !!}

                        @include('sorteos.formulario')
                        
                        <div class="form-group">
                            {!! Form::submit(trans('mensajes.update'), ['class' => 'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection