@extends('layouts.app')

@section('content')
<div class="col-sm-8">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{trans('mensajes.unirse-a-sorteo')}}
                <small>{{$sorteo->fecha_sorteo}}</small>
            </h1>
            <!-- <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol> -->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
            	<div class="panel-heading">
            		<h2 class="text-center">{{trans('mensajes.como-participar')}}</h2>
            	</div>                         
                <div class="panel-body"> 
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
    
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">                              
                <div class="panel-body">
                    <div class="panel-heading">              
                        <h2>{{trans('mensajes.add')}} {{trans('mensajes.transferencia')}}</h2>
                    </div>
                    <div class="panel-body">
                        <!-- <p><i class="fa fa-calendar"></i> {{$sorteo->fecha_sorteo}}</p> -->
                        <!-- <p><i class="fa fa-clock-o"></i> {{$sorteo->hora_sorteo}}</p> -->
                        <p><i class="fa fa-money"></i> {{trans('mensajes.precio-sorteo')}} {{$sorteo->precio_sorteo}}</p>
                        @include('errors.errors')

                        {!! Form::open(['url' =>['guardar-union-sorteo',$sorteo->id], 'method' => 'POST']) !!}

                            <div class="form-group">
                                {!! Form::label('id_transferencia', trans('mensajes.id-transferencia').':') !!}
                                {!! Form::text('id_transferencia', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit(trans('mensajes.add'), ['class' => 'btn btn-primary']) !!}
                            </div>

                        {!! Form::close() !!}
                    </div>             
                    
                </div>
            </div>
        </div>    
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">                              
                <div class="panel-body">
                    <div class="panel-heading">              
                        <h2>{{trans('mensajes.mis')}} {{trans('mensajes.sorteos')}}</h2>
                    </div>
                    @forelse($sorteos as $sorteo)
                        <div class="row">
                            <div class="col-lg-6">
                                <p>{{$sorteo->id_transferencia}}</p>
                            </div>
                            <div class="col-lg-6">
                            @if($sorteo->confirmar_pago==0)
                                <p class="text-danger">{{trans('mensajes.pago-no-confirmado')}}</p>
                            @elseif($sorteo->confirmar_pago==1)
                                <p class="text-success"><i class="fa fa-check"></i> {{trans('mensajes.pago-confirmado')}}</p>
                            @endif
                            </div>
                        </div>
                    @empty
                        <p>{{trans('mensajes.no-unido-sorteo')}}</p>
                    @endforelse

                </div>
            </div>
        </div>    
    </div>
</div>
@endsection