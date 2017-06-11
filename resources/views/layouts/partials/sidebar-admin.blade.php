@php
  $perfil = App\User::join('otros_datos_usuario','otros_datos_usuario.usuario_id','users.id')
  ->where('otros_datos_usuario.usuario_id',Auth::user()->id)
  ->select('otros_datos_usuario.foto_perfil')
  ->first();
@endphp
<div class="col-sm-3 "> 
  <div class="nav-side-menu">
      <div class="brand">
        @if($perfil!=null)
          {!! Html::image('storage/'.Auth::user()->id.'/foto_perfil/'.$perfil->foto_perfil, 'Imagen', array('class' => 'img-profile img-circle')) !!}
        @endif
        <div>{{ Auth::user()->name }}</div>
        <a class="btn btn-primary" href="{{ url('ver-usuario',Auth::user()->id) }}">
            <i class="fa fa-user"></i> {{trans('mensajes.mi-perfil')}}
        </a>
      </div>
      <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    
            <div class="menu-list">
    
              <ul id="menu-content" class="menu-content collapse out">

                  <li>
                    <a href="{{url('/')}}"><i class="fa fa-home fa-lg"></i> {{trans('mensajes.home')}}</a> 
                  </li>

                  <li>
                    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard fa-lg"></i> {{trans('mensajes.dashboard')}}</a> 
                  </li>

                  <li>
                    <a href="{{url('mostrar-usuarios')}}"><i class="fa fa-users fa-lg"></i> {{trans('mensajes.usuarios')}}</a> 
                  </li>
                  <li>
                    <a href="{{url('mostrar-sorteos')}}"><i class="fa fa-btc fa-lg"></i> {{trans('mensajes.sorteos')}}</a> 
                  </li>

                  <li>
                    <a href="{{url('premios')}}"><i class="fa fa-gift fa-lg"></i> {{trans('mensajes.premios')}}</a> 
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-calendar fa-lg"></i> {{trans('mensajes.calendario')}}</a>
                  </li>

                  <li>
                    <a href="{{url('sorteo-en-vivo')}}"><i class="fa fa-video-camera fa-lg"></i> {{trans('mensajes.sorteo-en-vivo')}}</a> 
                  </li>

                  <li>
                    <a href="{{url('jugar-ruleta')}}"><i class="fa fa-play fa-lg"></i> {{trans('mensajes.jugar-ruleta')}}</a>
                  </li>
             
              </ul>
            </div>
        </div>
</div>