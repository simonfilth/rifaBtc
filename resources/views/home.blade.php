<!-- @ extends('layouts.app')

@ section('content')
Home
@ endsection -->
@if(Auth::check())
@php
  $perfil = App\User::join('otros_datos_usuario','otros_datos_usuario.usuario_id','users.id')
  ->where('otros_datos_usuario.usuario_id',Auth::user()->id)
  ->select('otros_datos_usuario.foto_perfil')
  ->first();
@endphp
@endif
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cryptosorteos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="keywords" content="bitcoin,sorteos btc,crytosorteo, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="Remotepcsolutions.com" />


	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800" rel="stylesheet">

	<!-- Animate.css -->
	{!! Html::style('cryptosorteo/css/animate.css') !!}
	<!-- Icomoon Icon Fonts-->
	{!! Html::style('cryptosorteo/css/icomoon.css') !!}
	<!-- Bootstrap  -->
	{!! Html::style('cryptosorteo/css/bootstrap.css') !!}
	<!-- Theme style  -->
	{!! Html::style('cryptosorteo/css/style.css') !!}
	{!! Html::style('cryptosorteo/css/landing22.css') !!}
	{!! Html::style('components/css/font-awesome.min.css') !!}
	
	</head>
	<body>


	<div class="fh5co-loader"></div>

	<div id="page" >
	<nav class="fh5co-nav" role="navigation">

		<div class="top">
			<div class="container">
				<div class="row">
					<div class="col-xs-6 text-left">
						<p style="color:white;">
							{!! Html::image('cryptosorteo/images/ACUMULADO.png', 'Acumulado', array('height' => '50', 'width' => '220')) !!}
							0.012345670 BTC
						</p>
					</div>
					<div class="col-xs-3 text-right">
						@if (Auth::check())
							<li class="dropdown" style="list-style: none; margin-top: 20px;">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:white;">
		                            @if($perfil!=null)
		                              {!! Html::image('storage/'.Auth::user()->id.'/foto_perfil/'.$perfil->foto_perfil, 'Imagen', array('class' => 'img-nav img-circle')) !!}
		                            @endif
		                            {{ Auth::user()->name }} <span class="caret"></span>
		                        </a>

		                        <ul class="dropdown-menu pull-right" role="menu">
		                            @if(Auth::user()->tipo_usuario=='Administrador')
		                            <li>
		                                <a href="{{ url('dashboard') }}">
		                                    <i class="fa fa-dashboard"></i> {{trans('mensajes.dashboard')}}
		                                </a>
		                            </li>
		                            @elseif(Auth::user()->tipo_usuario=='Cliente')
		                            <li>
		                                <a href="{{ url('dashboard') }}">
		                                    <i class="fa fa-dashboard"></i> {{trans('mensajes.home')}}
		                                </a>
		                            </li>
		                            @endif
		                            <li>
		                                <a href="{{ url('ver-usuario',Auth::user()->id) }}">
		                                    <i class="fa fa-user"></i> {{trans('mensajes.mi-perfil')}}
		                                </a>
		                            </li>
		                            <li>
		                                <a href="{{ route('logout') }}"
		                                    onclick="event.preventDefault();
		                                             document.getElementById('logout-form').submit();">
		                                    <i class="fa fa-sign-out"></i> {{trans('mensajes.logout')}}
		                                </a>

		                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                                    {{ csrf_field() }}
		                                </form>
		                            </li>
		                        </ul>
		                    </li>
						@endif
					</div>
					<div class="col-xs-3 text-right">
						{!! Html::image('cryptosorteo/images/criptomonedas.png', 'Cryptomonedas', array('height' => '50', 'width' => '220')) !!}
					</div>
				</div>
			</div>
		</div>
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-2">
						{!! Html::image('cryptosorteo/images/logo3.png', 'Logo', array('height' => '50', 'width' => '230')) !!}
					</div>
				<!--
						<div id="fh5co-logo"><a href="index.html">Criptorifas<span><p style="color:#fff2c2";>.ML</p></span></a></div>
					</div>-->


					<div class="col-xs-10 text-right menu-1">
					<h5>	<ul >

						@if (Auth::guest())
							<li><a href="{{ route('register') }}">{{trans('mensajes.registrate')}}</a></li>
							<li><a href="{{ route('login') }}">{{trans('mensajes.ingresar')}}</a></li>
						@endif
							<li><a href="#" data-toggle="modal" data-target="#comoFunciona" >{{trans('mensajes.como-funciona')}}<i class=""></i></a></a></li>
							<li><a href="#" data-toggle="modal" data-target="#premios" >{{trans('mensajes.sistema-de-premios')}}<i class=""></i></a></a></li>
							<li><a href="#" data-toggle="modal" data-target="#contacto" >{{trans('mensajes.contacto')}}</a></li>

						@if(session()->get('lang')=='en')
		                    <li>
		                    <a href="{{ url('lang', ['es']) }}">Es
		                        <!-- {!! Html::image('assets/imagenes/idioma-icons/eeuu-icon.png', 'Imagen', array('class' => 'img-flag')) !!} -->
		                    </a>
		                    </li>
		                @else
		                    <li>
		                    <a href="{{ url('lang', ['en']) }}">En
		                        <!-- {!! Html::image('assets/imagenes/idioma-icons/ecuador-icon.png', 'Imagen', array('class' => 'img-flag')) !!} -->
		                    </a>
		                    </li>
		                @endif

						</ul></h5>
					</div>
				</div>

			</div>
		</div>
	</nav>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-background" role="banner">
		<div class="row">
			<div class="col-sm-12">
				{!! Html::image('cryptosorteo/images/cryptoruleta.png', 'Cryptoruleta', array('height' => '250', 'width' => '250')) !!}
			</div>
		</div>
		

	</header>

	<div id="fh5co-services" class="fh5co-bg-section">
		<div class="container">
			<div class="row">
				<div class="col-md-4 text-center animate-box">
					<div class="services">
						<span>
							{!! Html::image('cryptosorteo/images/numero1.png', 'Numero 1', array('class' => 'img-responsive')) !!}
						</span>
						<h3>{{trans('mensajes.registrate')}}</h3>
						<p>{{trans('mensajes.solo-debes-ingresar')}}</p>
						<p><a href="{{ route('register') }}" class="btn btn-primary btn-outline btn-sm">{{trans('mensajes.registrarme')}} <i class=""></i></a></p>
					</div>
				</div>
				<div class="col-md-4 text-center animate-box">
					<div class="services">
						<span>
							{!! Html::image('cryptosorteo/images/numero2.png', 'Numero 2', array('class' => 'img-responsive')) !!}
						</span>
						<h3>{{trans('mensajes.participa')}}</h3>
						<p>{{trans('mensajes.una-vez-registrado')}}</p>
						<p><a href="#" class="btn btn-primary btn-outline btn-sm" data-toggle="modal" data-target="#participar" > {{trans('mensajes.como-participar')}} <i class=""></i></a></p>
					</div>
				</div>
				<div class="col-md-4 text-center animate-box">
					<div class="services">
						<span>
							{!! Html::image('cryptosorteo/images/numero3.png', 'Numero 3', array('class' => 'img-responsive')) !!}
						</span>
						<h3>{{trans('mensajes.juega')}}</h3>
						<p>{{trans('mensajes.cuando-estes-participando')}}</p>
						<p><a href="#" class="btn btn-primary btn-outline btn-sm" data-toggle="modal" data-target="#comoJugar" >{{trans('mensajes.como-jugar')}}  <i class=""></i></a></p>
					</div>
				</div>
			</div>
		</div>

	</div>



	<footer>
	<p> <center>  © 2017 <a href="https://www.remotepcsolutions.com/develop/">RemotePcSolutions</a>  All Rights Reserved.</center>


         </p>
 	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	</footer>





	<!--modal -->



<div class="modal-footer">
	<div class="modal fade" id="comoJugar" tabindex="-1" role="dialog" aria-labelledby="comoJugar" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<center>
							<h3 class="modal-title heading-primary center" id="comoJugar">{{trans('mensajes.como-jugar')}}</h3>
						<center>
				</div>
				<div class="modal-body text-justify">
					<p>
						<center>
							<h4>{{trans('mensajes.como-jugar-1')}}</h4>
						</center>
						<ol>
							<li>{{trans('mensajes.como-jugar-2')}}</li>
							<li>{{trans('mensajes.como-jugar-3')}}</li>
							<li>{{trans('mensajes.como-jugar-4')}}</li>
						</ol>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>


	<!--modal -->

	<div class="modal-footer">
		<div class="modal fade" id="participar" tabindex="-1" role="dialog" aria-labelledby="participar" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<center>
							<h3 class="modal-title heading-primary center" id="participar">{{trans('mensajes.como-participar')}}</h3>
						</center>
					</div>
					<div class="modal-body text-justify">
						<p>
							<ol>
	                            <center>
	                                <h4>{{trans('mensajes.como-participar-1')}}</h4>
	                            </center>

	                            <li>{{trans('mensajes.como-participar-2')}}</li>
	                             <center>
	                                {!! Html::image('cryptosorteo/images/direccionbtc.png', 'Dirección BTC', array('height' => '100', 'width' => '100')) !!}
	                             </center>
	                             <center> <ul>16ZTktG2PaimUeMv7NeRwfWrWjeyarMgDE</ul> </center>

	                            <li>{{trans('mensajes.como-participar-3')}}</li>
	                            <li>{{trans('mensajes.como-participar-4')}}</li>
	                            <li>{{trans('mensajes.como-participar-5')}}</li>
	                        </ol>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--moda de sistema de premios-->


	<div class="modal-footer">
		<div class="modal fade" id="premios" tabindex="-1" role="dialog" aria-labelledby="premios" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<center>
							<h3 class="modal-title heading-primary center" id="premios">¿Cuales Son los Premios?</h3>
						</center>
					</div>
					<div class="modal-body text-justify">
						<p>
							<h5>Por cada ruleta tirada de 50 jugadores, existiran 3 ganadores </h5>
							<ol>
								<li> El primer ganador se ganara el 50% del valor acumulado</li>
								<li>El segundo ganador se ganara el 20% del valor acumulado</li>
								<li>El tercerganador se ganara el 10% del valor acumulado</li>

						    </ol>
							<h4> ¿3 ganadores? </h4>
						</p>
						<h5> Si, 3 ganadores para aumentar las probabilidades de ganancia de cada jugador </h5>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Modal de como funciona-->



	<div class="modal-footer">
		<div class="modal fade" id="comoFunciona" tabindex="-1" role="dialog" aria-labelledby="comoFunciona" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<center>
							<h3 class="modal-title heading-primary center" id="comoFunciona">¿Como Funciona?</h3>
						</center>
					</div>
					<div class="modal-body text-justify">
						<p>
							<h4>Cuando el jugador realiza el pago y es verificado, entra en nuestra base de datos y automaticamente esta participando. </h4>
							</br>
							<h4>Cada participante podra ver su nombre en la lista de participantes al momento de ser agregado al sorteo.</h4>
							</br>
							<center>
								{!! Html::image('cryptosorteo/images/fotosorteo1.png', 'Ejemplo 1 Sorteo', array('class' => 'img-responsive')) !!}
							</center>
							</br></br>
							<h4>A cada participante se le asiganara un color para el momento de tirar la ruleta  ("CADA COLOR ES UNICO").</h4>
							</br>
							<center>
								{!! Html::image('cryptosorteo/images/fotosorteo2.png', 'Ejemplo 2 Sorteo', array('class' => 'img-responsive')) !!}
							</center>
							</br></br>
							<h4>En el momento que la ruleta termine de girar automaticamente saldrá el nombre del ganador.</h4>
							</br>
							<center>
								{!! Html::image('cryptosorteo/images/fotosorteo3.png', 'Ejemplo 3 Sorteo', array('class' => 'img-responsive')) !!}
							</center>
					</div>
				</div>
			</div>
		</div>
	</div>

<!--moda de sistema de premios-->


	<div class="modal-footer">
		<div class="modal fade" id="contacto" tabindex="-1" role="dialog" aria-labelledby="contacto" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<center>
							<h3 class="modal-title heading-primary center" id="premios">{{trans('mensajes.contactanos')}}</h3>
						</center>
					</div>
					<div class="modal-body text-justify">
						@include('errors.errors')

	                    {!! Form::open(['url' => 'contactanos', 'method' => 'post']) !!}

	                        <div class="form-group">
							    {!! Form::text('name', null, ['class' => 'form-control','placeholder' => trans('mensajes.name'),'required']) !!}
							</div>
							<div class="form-group">
							    {!! Form::email('email', null, ['class' => 'form-control','placeholder' => trans('mensajes.email'),'required']) !!}
							</div>
							<div class="form-group">
							    {!! Form::textarea('mensaje', null, ['class' => 'form-control','placeholder' => trans('mensajes.mensaje'),'required']) !!}
							</div>
                     
	                        <div class="form-group">
	                            {!! Form::submit(trans('mensajes.submit'), ['class' => 'btn btn-primary']) !!}
	                        </div>

	                    {!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Modal de como funciona-->




	<!-- jQuery -->
	<!-- {!! Html::script('components/js/jquery.js') !!} -->
	{!! Html::script('cryptosorteo/js/jquery.min.js') !!}
	<!-- Bootstrap -->
	{!! Html::script('cryptosorteo/js/bootstrap.min.js') !!}
	<!-- Waypoints -->
	{!! Html::script('cryptosorteo/js/jquery.waypoints.min.js') !!}
{!! Html::script('cryptosorteo/js/jquery.stellar.min.js') !!}
	{!! Html::script('cryptosorteo/js/jquery.easing.1.3.js') !!}
	
	{!! Html::script('cryptosorteo/js/owl.carousel.min.js') !!}

	<!-- Main -->
	{!! Html::script('cryptosorteo/js/main.js') !!}
	
	<!-- Smartsupp Live Chat script -->
		<!-- <script type="text/javascript">
		var _smartsupp = _smartsupp || {};
		_smartsupp.key = '8d905a47427c30952678dbe77fd65da2320ae69c';
		_smartsupp.loginEmailControl = false;
		window.smartsupp||(function(d) {
			var s,c,o=smartsupp=function(){ o..push(arguments)};o.=[]; 
			s=d.getElementsByTagName('script')[0];c=d.createElement('script');
			c.type='text/javascript';c.charset='utf-8';c.async=true;
			c.src='//www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
		})(document);
		</script> -->
	</body>
</html>
