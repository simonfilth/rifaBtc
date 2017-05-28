{!! csrf_field() !!}

<div class="form-group">
    {!! Form::label('fecha_rifa', 'Fecha de rifa') !!}
    {!! Form::text('fecha_rifa', null, ['class' => 'form-control datepicker', 'readonly' => 'true', 'style'=>'cursor:pointer;']) !!}
</div>

<div class="form-group">
    {!! Form::label('hora_rifa', 'Hora de rifa:') !!}
    {!!Form::select('hora_rifa', config('options.horas'), null, ['class' => 'form-control'])!!}
</div>

<div class="form-group">
    {!! Form::label('precio_rifa', 'Precio de rifa:') !!}
    {!! Form::text('precio_rifa', null, ['class' => 'form-control']) !!}
</div>

