@extends('layouts.app')

@section('content')
<!-- <div class="container">     <div class="row">-->

        <div class="col-md-8">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Panel Administrativo 
                        <!-- <small>Statistics Overview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                    </ol>
                    
                </div>
            </div>
            <div class="row">
            
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <!-- <a href="{{url('mostrar-participantes')}}" class="href-panel"> -->
                                <a @click="addOrRemoveTable" class="href-panel">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{count($participantes)}}</div>
                                            <div><!-- New Comments! --></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">{{trans('mensajes.lista-participantes')}}</div>
                                    </div> 
                                </a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <a href="#" class="href-panel">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-trophy fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{count($participantes)}}</div>
                                            <div><!-- New Comments! --></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">{{trans('mensajes.ultimos-ganadores')}}</div>
                                    </div> 
                                </a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <a href="#" class="href-panel">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{count($participantes)}}</div>
                                            <div><!-- New Comments! --></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">{{trans('mensajes.unirse-sorteo')}}</div>
                                    </div> 
                                </a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <a href="#" class="href-panel">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{count($participantes)}}</div>
                                            <div><!-- New Comments! --></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">{{trans('mensajes.proximos-sorteos')}}</div>
                                    </div> 
                                </a>
                                
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div v-if="clickParticipantes">
                                <table id="table-responsive" class="table table-condensed table-striped sortable ">
                                    <thead>
                                        <th>Nombre</th>
                                        <th>ID Wallet</th>
                                        @if(Auth::user()->tipo_usuario == 'Administrador')
                                        <th>ID Transferencia</th>
                                        <th>Confirmar Pago</th>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @forelse($participantes as $participante)
                                        <tr>
                                            <td>{!!$participante->name!!} {!!$participante->apellido!!}</td>
                                            <td>{!!$participante->id_wallet!!}</td>
                                        @if(Auth::user()->tipo_usuario == 'Administrador')
                                            <td>{!!$participante->id_transferencia!!}</td>
                                            @if($participante->confirmar_pago == 0)
                                                <td><a class="btn btn-primary" href="{{url('confirmar-pago',$participante->id_transferencia)}}">Confirmar pago</a></td>
                                            @elseif($participante->confirmar_pago == 1)
                                                <td><p class="text-success"><i class="fa fa-check"></i> Pago confirmado</p></td>
                                            @endif
                                        @endif
                                        </tr>
                                        @empty
                                            <tr><td align="center" colspan="4">No se encontraron resultados</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- <h1>Bienvenido, @ { { usuarios }}</h1> -->
                             <!-- <input type="txt" v- model="usuarios"> -->
                             <hr>
                             <pre>
                                 @{{ $data }}
                             </pre>
                        </div>
                    </div>
                </div>
     <!--    </div>
   </div>
 </div> -->
 <script type="text/javascript">
 // alert("{ { $ users[0]['name']}}");
     new Vue({
        el: "#app",
        data: {
            clickParticipantes: false
        },
        methods: {
            addOrRemoveTable: function(){
                if(this.clickParticipantes){
                    this.clickParticipantes=false;
                }
                else
                    this.clickParticipantes=true;
            }
        }
     });
 </script>
@endsection