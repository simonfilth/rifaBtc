@extends('layouts.app')

@section('content')
panel cliente
<div class="text-success text-center">
    @if(Session::has('message'))
        {{Session::get('message')}}
    @endif
</div>
@endsection
