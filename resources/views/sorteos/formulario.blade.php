{!! csrf_field() !!}

<div class="form-group">
    {!! Form::label('fecha_sorteo', trans('mensajes.fecha')) !!}
    {!! Form::text('fecha_sorteo', null, ['class' => 'form-control datepicker', 'readonly' => 'true', 'style'=>'cursor:pointer;']) !!}
</div>

<div class="form-group">
    {!! Form::label('hora_sorteo', trans('mensajes.hora')) !!}
    {!!Form::select('hora_sorteo', config('options.horas'), null, ['class' => 'form-control'])!!}
</div>

<div class="form-group">
    {!! Form::label('precio_sorteo', trans('mensajes.precio')) !!}
    {!! Form::text('precio_sorteo', null, ['class' => 'form-control']) !!}
</div>

