@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-danger" style="margin-top: 50px;">
					<div class="panel-heading">
						<h2 class="text-center"><i class="fa fa-lock fa-2x"></i> !Acceso Restringido¡</h2>
					</div>
					<div class="panel-body text-center">
						<h4>No tiene permisos para acceder a esta página</h4>
						<br>
						<a href="{{url('/')}}"><i class="fa fa-arrow-circle-o-left fa-lg"></i> Volver al sitio</a>
					</div>					
				</div>
			</div>
		</div>
		<div style="margin-top: 18%;"></div>
	</div>
@endsection