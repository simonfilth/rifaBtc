{!! csrf_field() !!}

<div class="form-group">
    {!! Form::label('name', trans('mensajes.nombre').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('apellido', trans('mensajes.apellido').':') !!}
    {!! Form::text('apellido', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', trans('mensajes.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('id_wallet', trans('mensajes.id-wallet').':') !!}
    {!! Form::text('id_wallet', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('password', trans('mensajes.password').':') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

@if(Auth::user()->tipo_usuario == 'Administrador')
<div class="form-group">
    {!! Form::label('tipo_usuario', trans('mensajes.tipo-usuario').':') !!}
    {!!Form::select('tipo_usuario', $tipo_usuario, null, ['class' => 'form-control'])!!}
</div>
@endif
