@extends('layouts.app')

@section('content')
<!-- <div class="container">     <div class="row">-->

<div class="col-md-8">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{trans('mensajes.asignar-ganadores')}}   
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
        <div class="col-sm-12">
            <table id="table-responsive" class="table table-condensed table-striped sortable ">
                <thead>
                    <th>#</th>
                    <th>{{trans('mensajes.name')}}</th>
                    <th>{{trans('mensajes.id-transferencia')}}</th>
                    <th>{{trans('mensajes.elegir')}}</th>
                </thead>
                <tbody>
                    <tr v-for="(participante,i) in participantes">   
                        <td>@{{i+1}}</td>
                        <td>@{{participante.name}} @{{participante.apellido}}</td>
                        <td>@{{participante.id_transferencia}}</td>
                        <td>
                        @forelse($consulta_ganadores as $consulta)
                        	@if($consulta->lugar==1)
                        		<a class="btn btn-warning" :href="'cambiar-premio/'+{{$consulta->id}}+'/'+participante.usuario_id+'/1'" disabled>1</a>
                        		<a class="btn btn-primary" :href="'cambiar-premio/'+{{$consulta->id}}+'/'+participante.usuario_id+'/2'">2</a>
	                        	<a class="btn btn-danger" :href="'cambiar-premio/'+{{$consulta->id}}+'/'+participante.usuario_id+'/3'">3</a>
	                        @elseif($consulta->lugar==2)
                        		<a class="btn btn-warning" :href="'cambiar-premio/'+{{$consulta->id}}+'/'+participante.usuario_id+'/1'">1</a>
                        		<a class="btn btn-primary" :href="'cambiar-premio/'+{{$consulta->id}}+'/'+participante.usuario_id+'/2'" disabled>2</a>
	                        	<a class="btn btn-danger" :href="'cambiar-premio/'+{{$consulta->id}}+'/'+participante.usuario_id+'/3'">3</a>
	                        @elseif($consulta->lugar==3)
                        		<a class="btn btn-warning" :href="'cambiar-premio/'+{{$consulta->id}}+'/'+participante.usuario_id+'/1'">1</a>
                        		<a class="btn btn-primary" :href="'cambiar-premio/'+{{$consulta->id}}+'/'+participante.usuario_id+'/2'">2</a>
	                        	<a class="btn btn-danger" :href="'cambiar-premio/'+{{$consulta->id}}+'/'+participante.usuario_id+'/3'" disabled>3</a>
                        	@endif
                        @empty
                        	<a class="btn btn-warning" :href="'asignar-premio/'+participante.sorteo_id+'/'+participante.usuario_id+'/1'">1</a>
	                        <a class="btn btn-primary" :href="'asignar-premio/'+participante.sorteo_id+'/'+participante.usuario_id+'/2'">2</a>
	                        <a class="btn btn-danger" :href="'asignar-premio/'+participante.sorteo_id+'/'+participante.usuario_id+'/3'">3</a>
                        @endforelse
                        
                        </td>
                    </tr>

                    <template v-if="participantes.length == 0">
                            <td colspan="4" align="center">
                                {{trans('mensajes.todavia-no-hay-participantes')}}
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

<script type="text/javascript">

window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>

var dataParticipantes = {!! $dataParticipantes !!};

    vm = new Vue({
        el: "#app",
        data: {
            participantes: dataParticipantes
        },
        methods: {
        	asignarPremio: function(participantes,lugar) {
        		// console.log(participantes);
        		// console.log(lugar);
                axios.post('asignar-premio/'+participantes.sorteo_id+'/'+participantes.sorteo_id+'/'+lugar).then(function (response) {
                    console.log("respuesta ganador");
                    console.log(response.data);
                    // vm.getVueSorteos();
                })
            }
        }
     });
 </script>
@endsection