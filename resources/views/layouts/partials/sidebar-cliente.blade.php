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
                    <a class="btn-block" href="{{url('dashboard')}}"><i class="fa fa-home fa-lg"></i> {{trans('mensajes.home')}}</a> 
                  </li>

                  <li>
                    <a class="btn-block" href="{{url('premios')}}"><i class="fa fa-gift fa-lg"></i> {{trans('mensajes.premios')}}</a> 
                  </li>

                  <li>
                    <a class="btn-block" href="{{url('unirse-a-sorteo')}}"><i class="fa fa-cube fa-lg"></i> {{trans('mensajes.unirse-sorteo')}}</a> 
                  </li>

                  <li>
                    <a class="btn-block" href="{{url('mostrar-participantes')}}"><i class="fa fa-users fa-lg"></i> {{trans('mensajes.lista-participantes')}}</a> 
                  </li>

                  <li>
                    <a class="btn-block" href="{{url('sorteo-en-vivo')}}"><i class="fa fa-video-camera fa-lg"></i> {{trans('mensajes.sorteo-en-vivo')}}</a> 
                  </li>

             
              </ul>
            </div>
        </div>
</div>