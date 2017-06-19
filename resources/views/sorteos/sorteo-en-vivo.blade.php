@extends('layouts.app')

@section('content')
<div class="col-sm-8">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{trans('mensajes.sorteo-en-vivo')}}
                
            </h1>
            <div class="text-success text-center">
                @if(Session::has('message'))
                    {{Session::get('message')}}
                @endif
            </div> 
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
            	<div class="panel-heading">
            		<!-- <h2 class="panel-title">
            			{{trans('mensajes.sorteo-en-vivo')}}
            		</h2> -->
            	</div>
            	
            	<div class="panel-body text-center">
                 <iframe width="560" height="315" src="https://gaming.youtube.com/embed/MvDCZAeRnbk" frameborder="0" allowfullscreen></iframe>  
                 <br>
                 <iframe width="480" height="270" src="https://gaming.youtube.com/live_chat?v=MvDCZAeRnbk&embed_domain=http://rifa-bitcoins.dev/sorteo-en-vivo" frameborder="0" allowfullscreen=""></iframe>   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection