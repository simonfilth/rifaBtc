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
            <i class="fa fa-user"></i> Mi Perfil
        </a>
      </div>
      <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    
            <div class="menu-list">
    
              <ul id="menu-content" class="menu-content collapse out">

                  <li  data-toggle="collapse" data-target="#usuarios" class="collapsed">
                    <a href="{{url('/')}}"><i class="fa fa-home fa-lg"></i> Inicio</a> 
                  </li>

                  <li  data-toggle="collapse" data-target="#usuarios" class="collapsed">
                    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard fa-lg"></i> Dashboard</a> 
                  </li>

                  <li  data-toggle="collapse" data-target="#usuarios" class="collapsed">
                    <a href="{{url('mostrar-usuarios')}}"><i class="fa fa-users fa-lg"></i> Administrar</a> 
                  </li>
                  <li  data-toggle="collapse" data-target="#usuarios" class="collapsed">
                    <a href="{{url('mostrar-rifas')}}"><i class="fa fa-btc fa-lg"></i> Rifas</a> 
                  </li>

                  <li  data-toggle="collapse" data-target="#usuarios" class="collapsed">
                    <a href="{{url('agregar-sorteo')}}"><i class="fa fa-plus fa-lg"></i> {{trans('mensajes.agregar-sorteo')}}</a> 
                  </li>

                  <li  data-toggle="collapse" data-target="#usuarios" class="collapsed">
                    <a href="{{url('/')}}"><i class="fa fa-gift fa-lg"></i> Premios</a> 
                  </li>

                  <li data-toggle="collapse" data-target="#citas" class="collapsed">
                    <a href="#"><i class="fa fa-calendar fa-lg"></i> Calendario</a>
                  </li>
             
              </ul>
            </div>
        </div>
</div>