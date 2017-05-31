@if(Auth::check())
@php
  $perfil = App\User::join('otros_datos_usuario','otros_datos_usuario.usuario_id','users.id')
  ->where('otros_datos_usuario.usuario_id',Auth::user()->id)
  ->select('otros_datos_usuario.foto_perfil')
  ->first();
@endphp
@endif
<nav class="navbar navbar-principal navbar-fixed-top" id="mainNav">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a class="color-blanco" href="{{ route('login') }}">Iniciar Sesión</a></li>
                    <li><a class="color-blanco" href="{{ route('register') }}">Registrarse</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            @if($perfil!=null)
                              {!! Html::image('storage/'.Auth::user()->id.'/foto_perfil/'.$perfil->foto_perfil, 'Imagen', array('class' => 'img-nav img-circle')) !!}
                            @endif
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @if(Auth::user()->tipo_usuario=='Administrador')
                            <li>
                                <a href="{{ url('dashboard') }}">
                                    <i class="fa fa-dashboard"></i> Dashboard
                                </a>
                            </li>
                            @elseif(Auth::user()->tipo_usuario=='Cliente')
                            <li>
                                <a href="{{ url('panel-cliente') }}">
                                    <i class="fa fa-dashboard"></i> Panel
                                </a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ url('ver-usuario',Auth::user()->id) }}">
                                    <i class="fa fa-user"></i> Mi Perfil
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> Cerrar Sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>