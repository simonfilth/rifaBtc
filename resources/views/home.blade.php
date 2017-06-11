<!-- @ extends('layouts.app')

@ section('content')
Home
@ endsection -->
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
	{!! Html::style('components/bootstrap/css/bootstrap.min.css') !!}
	<!-- Theme style  -->
	{!! Html::style('cryptosorteo/css/style.css') !!}
	{!! Html::style('cryptosorteo/css/landing22.css') !!}
	{!! Html::style('cryptosorteo/css/nav.css') !!}

	
	</head>
	<body>


	<div class="fh5co-loader"></div>

	<div id="page" >
	<nav class="fh5co-nav" role="navigation">

		<div class="top">
			<div class="container">
				<div class="row">
					<div class="col-xs-6 text-letf">
						<p style="color:white;">
							{!! Html::image('cryptosorteo/images/ACUMULADO.png', 'Acumulado', array('height' => '50', 'width' => '220')) !!}
							0.012345670 BTC
						</p>
					</div>
					<div class="col-xs-6 text-right">
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
					<h5>	<ul>

						 @if (Auth::guest())
							<li><a href="{{ route('register') }}">Registrate</a></li>
							<li><a href="{{ route('login') }}">ingresar</a></li>
						@else
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
						@endif
							<li><a href="#" data-toggle="modal" data-target="#comoFunciona" >Como funciona<i class=""></i></a></a></li>
							<li><a href="#" data-toggle="modal" data-target="#premios" >SISTEMA DE PREMIOS<i class=""></i></a></a></li>
							<li><a href="#">Contactos</a></li>


						</ul></h5>
					</div>
				</div>

			</div>
		</div>
	</nav>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-background" role="banner">

		<div>
			{!! Html::image('cryptosorteo/images/cryptoruleta.png', 'Cryptoruleta', array('height' => '250', 'width' => '250')) !!}
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
						<h3>Registrate</h3>
						<p>Solo debes ingresar tus datos para registrarte en nuestro sistema</p>
						<p><a href="#" class="btn btn-primary btn-outline btn-sm">Registrarme <i class=""></i></a></p>
					</div>
				</div>
				<div class="col-md-4 text-center animate-box">
					<div class="services">
						<span>
							{!! Html::image('cryptosorteo/images/numero2.png', 'Numero 2', array('class' => 'img-responsive')) !!}
						</span>
						<h3>Participa</h3>
						<p>Una vez registrado, podras acceder a tu panel adminstrativo donde podras entrar al sorteo</p>
						<p><a href="#" class="btn btn-primary btn-outline btn-sm" data-toggle="modal" data-target="#participar" > ¿Como participar? <i class=""></i></a></p>
					</div>
				</div>
				<div class="col-md-4 text-center animate-box">
					<div class="services">
						<span>
							{!! Html::image('cryptosorteo/images/numero3.png', 'Numero 3', array('class' => 'img-responsive')) !!}
						</span>
						<h3>Juega</h3>
						<p>Cuando estes participando, deberas esperar el momento que se llenen la cantidad de 50 jugadores y se estara avisando el momento en que se realizará el sorteo en vivo</p>
						<p><a href="#" class="btn btn-primary btn-outline btn-sm" data-toggle="modal" data-target="#comoJugar" >¿Como jugar? <i class=""></i></a></p>
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
							<h3 class="modal-title heading-primary center" id="comoJugar">Como Jugar</h3>
						<center>
				</div>
				<div class="modal-body text-justify">
					<p>
						<center>
							<h4>Una vez realizada la compra de boleto usted debera seguir las siguientes instrucciones:</h4>
						</center>
						<ol>
							<li>Debe dirigirse a la seccion "Sorteo en vivo".</li>
							<li>Alli podra visaualizar la cantidad de participantes inscrito para lanzar la ruleta.</li>
							<li>Cuando se complete los 50 jugadores, se enviará una notificacion para tirar la ruleta, esta sera en vivo. De no estar presente podra visualizar la lista de ganadores, en la seccion de ganadores.</li>
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
							<h3 class="modal-title heading-primary center" id="participar">¿Como participar?</h3>
						</center>
					</div>
					<div class="modal-body text-justify">
						<p>
							<ol>
								<center>
									<h4>Una vez registrado en nuestro sitio web debes realizar los siguientes pasos:</h4>
								</center>

								<li>Debes Comprar tu boleto o rifa desde tu wallet por el valor de 0.01 BTC enviandolo a la siguiente direccion: </li>
								 <center>
								 	{!! Html::image('cryptosorteo/images/direccionbtc.png', 'Dirección BTC', array('height' => '100', 'width' => '100')) !!}
								 </center>
								 <center> <ul>16ZTktG2PaimUeMv7NeRwfWrWjeyarMgDE</ul> </center>

								<li>Una vez iniciada la sesion en nuestro sitio web, debes dirigirte a "Unirse a Sorteo". </li>
								<li>En esta sesion debes colocar el ID de la transferencia realizada.</li>
								<li>Una vez confirmada la trasferencia, automanticamente entra a la base de datos de participantes.</li>
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




	<!-- jQuery -->
	<!-- {!! Html::script('components/js/jquery.js') !!} -->
	{!! Html::script('cryptosorteo/js/jquery.min.js') !!}
	<!-- Bootstrap -->
	{!! Html::script('components/bootstrap/js/bootstrap.min.js') !!}
	<!-- Waypoints -->
	{!! Html::script('cryptosorteo/js/jquery.waypoints.min.js') !!}

	{!! Html::script('cryptosorteo/js/jquery.easing.1.3.js') !!}
	{!! Html::script('cryptosorteo/js/jquery.stellar.min.js') !!}
	{!! Html::script('cryptosorteo/js/owl.carousel.min.js') !!}

	<!-- Main -->
	{!! Html::script('cryptosorteo/js/main.js') !!}
	

	</body>
</html>
