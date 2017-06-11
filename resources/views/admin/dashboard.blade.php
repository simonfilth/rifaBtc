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
            <div class="text-success text-center">
                @if(Session::has('message'))
                    {{Session::get('message')}}
                @endif
            </div> 
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
        <app-panel color_panel="yellow" click_panel="Unirse" fa_style="diamond" mensaje_panel="{{trans('mensajes.unirse-sorteo')}}"  huge_panel="U"></app-panel>
        @endif
        <app-panel color_panel="red" click_panel="Proximo" fa_style="angle-double-right" mensaje_panel="{{trans('mensajes.proximos-sorteos')}}"  huge_panel="P"></app-panel>

    </div>

    

    <div v-if="clickParticipantes" class="row">
        <div class="col-sm-12">
            <table id="table-responsive" class="table table-condensed table-striped sortable ">
                <thead>
                    <th>{{trans('mensajes.name')}}</th>
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

                    <template v-if="participantes.length == 0">
                        <tr>
                        @if(Auth::user()->tipo_usuario == 'Administrador')
                            <td colspan="4" align="center">
                        @else
                            <td colspan="2" align="center">
                        @endif
                                {{trans('mensajes.todavia-no-hay-participantes')}}
                            </td>
                        </tr>
                    </template>
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
                        <td>@{{ganador.fecha_sorteo}}</td>
                    </tr>
                    <template v-if="ganadores.length == 0">
                        <tr>
                            <td colspan="3" align="center">
                                {{trans('mensajes.todavia-no-hay-ganadores')}}
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-sm-12">
             <hr>
             <pre>
                 @{{ $data }}
             </pre>
        </div>
    </div> -->
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
            /*participantes: [],
            ganadores: [],*/
            // pagination: {
            //     total: 0,
            //     per_page: 2,
            //     from: 1,
            //     to: 0,
            //     current_page: 1,
            // },
            // offset: 4,
            // formErrors: {},
            // formErrorsUpdate: {}
            clickParticipantes: false,
            clickGanadores: false
        },
        // mounted() {
            // this.getVueDashboard();
            // this.getVueGanadores();
           /* this.getVueDashboard(this.pagination.current_page);
            this.getVueGanadores(this.pagination.current_page);*/
            
        // },
        // methods: {
           /* getVueDashboard: function(page) {
                axios.get('cargar-datos-dashboard?page='+page).then(function (response) {
                    vm.$nextTick(function() {
                        console.log(response.data.data);
                        this.participantes = response.data.data.data;;
                        this.pagination = response.data.pagination;

                    })
                });
            },
            getVueGanadores: function(page) {
                axios.get('cargar-datos-ganadores?page='+page).then(function (response) {
                    vm.$nextTick(function() {
                        console.log(response.data.data);
                        this.ganadores = response.data.data.data;
                        this.pagination = response.data.pagination;

                    })
                });
            },
            changePageGanadores: function(page) {
                this.pagination.current_page = page;
                this.getVueGanadores(page);
            },
            changePageParticipantes: function(page) {
                this.pagination.current_page = page;
                this.getVueDashboard(page);
            }*/
            /*getVueDashboard: function() {
                axios.get('cargar-datos-dashboard').then(function (response) {
                    vm.$nextTick(function() {
                        console.log("participantes");
                        console.log(response.data.data);
                        this.participantes = response.data.data;
                    })
                });
            },*/
           /* getVueGanadores: function() {
                axios.get('cargar-datos-ganadores').then(function (response) {
                    vm.$nextTick(function() {
                        console.log("ganadores");
                        console.log(response);
                        this.ganadores = response.data.data;

                   })
                });
            } */
        // }
     });
 </script>
@endsection