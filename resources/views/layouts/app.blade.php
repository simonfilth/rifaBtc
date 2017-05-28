@include('layouts.partials.htmlheader')
<body>
    <div id="app">
        @include('layouts.partials.nav')
    @if(Auth::check() and Auth::user()->tipo_usuario=='Administrador' and (!Request::is('/') and !Request::is('home')))
        @include('layouts.partials.sidebar')
         @yield('content')
    @else
        @yield('content')
    @endif
        
    </div>

    @include('layouts.partials.scripts')
    
