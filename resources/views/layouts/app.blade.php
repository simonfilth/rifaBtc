@include('layouts.partials.htmlheader')
<body>
    <div id="app">
        @include('layouts.partials.nav')
    @if(Auth::check())
        @include('layouts.partials.sidebar')
         @yield('content')
    @else
        @yield('content')
    @endif
        
    </div>

    @include('layouts.partials.scripts')
    
