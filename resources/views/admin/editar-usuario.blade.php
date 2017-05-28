@extends('layouts.app')

@section('content')
<div class="col-sm-9">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Usuario
                <small>Editar</small>
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