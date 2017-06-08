@extends('layouts.app')

@section('content')
<!-- <div class="container">     <div class="row">-->

<div class="col-md-8">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @if(Auth::user()->tipo_usuario == 'Administrador')
                    {{trans('mensajes.panel-administrativo')}}
                @else
                    {{trans('mensajes.dashboard')}}
                @endif
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol>
        </div>
    </div>
    <div class="row">

        <app-panel color_panel="primary" click_panel="Participantes" fa_style="users" mensaje_panel="{{trans('mensajes.lista-participantes')}}"  huge_panel="{{count($participantes)}}"></app-panel>
        <app-panel color_panel="green" click_panel="Ganadores" fa_style="trophy" mensaje_panel="{{trans('mensajes.ultimos-ganadores')}}"  huge_panel="{{count($ganadores)}}"></app-panel>
        @if(Auth::user()->tipo_usuario == 'Administrador')
        <app-panel color_panel="yellow" click_panel="Agregar" fa_style="plus" mensaje_panel="{{trans('mensajes.agregar-sorteo')}}"  huge_panel="A"></app-panel>
        @else
        <app-panel color_panel="yellow" click_panel="Unirse" fa_style="comments" mensaje_panel="{{trans('mensajes.unirse-sorteo')}}"  huge_panel="U"></app-panel>
        @endif
        <app-panel color_panel="red" click_panel="Proximo" fa_style="comments" mensaje_panel="{{trans('mensajes.proximos-sorteos')}}"  huge_panel="P"></app-panel>


        <!-- <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <a @click="addRemoveParticipantes" class="href-panel">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{count($participantes)}}</div>
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">{{trans('mensajes.proximos-sorteos')}}</div>
                        </div> 
                    </a>
                    
                </div>
            </div>
        </div> -->
    </div>
    <!-- <div v-if="clickParticipantes" class="row">
        <div class="col-sm-12">
            <div>
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
    </div> -->
    

    <div v-if="clickParticipantes" class="row">
        <div class="col-sm-12">
            <table id="table-responsive" class="table table-condensed table-striped sortable ">
                <thead>
                    <th>{{trans('mensajes.nombre')}}</th>
                    <th>{{trans('mensajes.id-wallet')}}</th>
                    @if(Auth::user()->tipo_usuario == 'Administrador')
                    <th>{{trans('mensajes.id-transferencia')}}</th>
                    <th>{{trans('mensajes.confirmar-pago')}}</th>
                    @endif
                </thead>
                <tbody>
                    <tr v-for="participante in participantes">   
                        <td>@{{participante.name}} @{{participante.apellido}}</td>
                        <td>@{{participante.id_wallet}}</td>
                    @if(Auth::user()->tipo_usuario == 'Administrador')
                        <td>@{{participante.id_transferencia}}</td>
                        <td v-if="participante.confirmar_pago == 0"><a class="btn btn-primary" :href="'confirmar-pago/'+participante.id_transferencia">{{trans('mensajes.confirmar-pago')}}</a></td>
                        <td v-else-if="participante.confirmar_pago == 1"><p class="text-success"><i class="fa fa-check"></i>{{trans('mensajes.pago-confirmado')}}</p></td>
                    @endif
                    </tr>
                    <div v-if="participantes.length == 0">
                        <tr>
                        @if(Auth::user()->tipo_usuario == 'Administrador')
                            <td colspan="4" align="center">
                        @else
                            <td colspan="2" align="center">
                        @endif
                                {{trans('mensajes.todavia-no-hay-participantes')}}
                            </td>
                        </tr>
                    </div>
                </tbody>
            </table>
        </div>
    </div>

    <div v-if="clickGanadores" class="row">
        <div class="col-sm-12">
            <table id="table-responsive" class="table table-condensed table-striped sortable ">
                <thead>
                    <th>{{trans('mensajes.nombre')}}</th>
                    <th>{{trans('mensajes.id-wallet')}}</th>
                    <th>{{trans('mensajes.fecha-sorteo')}}</th>
                </thead>
                <tbody>
                    <tr v-for="ganador in ganadores">   
                        <td>@{{ganador.name}} @{{ganador.apellido}}</td>
                        <td>@{{ganador.id_wallet}}</td>
                        <td>@{{ganador.fecha_rifa}}</td>
                    </tr>
                    <div v-if="ganadores.length == 0">
                        <tr>
                            <td colspan="3" align="center">
                                {{trans('mensajes.todavia-no-hay-ganadores')}}
                            </td>
                        </tr>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
             <!-- <hr>
             <pre>
                 @ { { $data }}
             </pre> -->
        </div>
    </div>
</div>


<script type="text/x-template" id="panel-template">
    <div class="col-lg-3 col-md-6">
        <div :class="panelColor">
            <div class="panel-heading">
                <a @click="addRemoveTable" class="href-panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <i :class="faStyle"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">@{{hugePanel}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">@{{mensajePanel}}</div>
                    </div> 
                </a> 
            </div>
        </div>
    </div>
</script>

<script type="text/javascript">

Vue.component('app-panel',{
    template: '#panel-template',
    props: ['color_panel','click_panel','fa_style','mensaje_panel','huge_panel'],
    /*data: {
        color_panel: '',
        click_panel: '',
        fa_style: '',
        mensaje_panel: '',
        huge_panel: ''
    },*/
    computed: {
        panelColor: function(){
            return 'panel panel-'+this.color_panel;
        },
        faStyle: function(){
            return 'fa fa-'+this.fa_style+' fa-5x';
        },
        mensajePanel: function(){
            return this.mensaje_panel;
        },
        hugePanel: function(){
            return this.huge_panel;
        }
    },
    methods: {
        addRemoveTable: function(){
            if (this.click_panel=='Participantes'){
                if(vm.clickParticipantes){
                    vm.clickParticipantes=false;
                }
                else{
                    vm.clickParticipantes=true;
                    vm.clickGanadores=false;
                }
            }

            if (this.click_panel=='Ganadores'){
                if(vm.clickGanadores){
                    vm.clickGanadores=false;
                }
                else{
                    vm.clickGanadores=true;
                    vm.clickParticipantes=false
                }
            }

            if (this.click_panel=='Unirse'){
                window.location.href = 'unirse-a-sorteo';
            }

            if (this.click_panel=='Agregar'){
                window.location.href = 'agregar-sorteo';
            }

            if (this.click_panel=='Proximo'){
                alert("construyendo");
            }       
        },
    }
});

var dataParticipantes = {!! $dataParticipantes !!};
var dataGanadores = {!! $dataGanadores !!};
    vm = new Vue({
        el: "#app",
        data: {
            participantes: dataParticipantes,
            ganadores: dataGanadores,
            clickParticipantes: false,
            clickGanadores: false
        }/*,
        methods: {
            addRemoveParticipantes: function(){
                if(this.clickParticipantes){
                    this.clickParticipantes=false;
                }
                else
                    this.clickParticipantes=true;
            }
        }*/
     });
 </script>
@endsection