@extends('layouts.app')

@section('content')
<div class="col-sm-9">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Usuario
                <small>Editar</small>
            </h1>
            @include('errors.errors')
            
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
                    <div class="text-success text-center">
                        @if(Session::has('message'))
                            {{Session::get('message')}}
                        @endif
                    </div> 
                    {!! Form::model($usuario, ['url' => ['guardar-foto-usuario', $usuario->usuario_id], 'method' => 'patch','files' => true]) !!}

                        <div class="form-group">
                            {!! Form::label('foto_perfil', 'Foto de Perfil:') !!}
                            {!! Form::file('foto_perfil') !!}
                        </div>

                        
                        <div class="form-group">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">                           
                <div class="panel-body"> 

                    {!! Form::model($usuario, ['url' => ['actualizar-usuario', $usuario->id], 'method' => 'patch']) !!}

                        @include('admin.formulario')
                        
                        <div class="form-group">
                            {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection