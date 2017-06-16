@extends('layouts.app')

@section('content')
<div class="col-sm-8" style="margin-top: 100px;">
	<h1>Jugadores</h1>
	@forelse($jugadores as $jugador)
		{!!$jugador->name!!} {!!$jugador->apellido!!},
	@empty
		<p>no hay participantes</p>
	@endforelse
</div>
@endsection
