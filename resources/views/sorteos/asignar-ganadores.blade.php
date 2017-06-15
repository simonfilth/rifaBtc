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
                @forelse($participantes as $i => $participante)
                    <tr>   
                        <td>{{$i+1}}</td>
                        <td>{{$participante->name}} {{$participante->apellido}}</td>
                        <td>{{$participante->id_transferencia}}</td>
                        <td>
                        
                            @if($participante->estado_ganador==1)
                                @php
                                    $consulta = App\modelos\Ganador::where('sorteo_usuario_id',$participante->id_su)->first();
                                @endphp
                                @if($consulta->lugar==1)
                                    <a class="btn btn-warning" href="{{url('cambiar-premio',[$consulta->id,$participante->id_su,'1'])}}" disabled>1</a>
                                    <a class="btn btn-primary" href="{{url('cambiar-premio',[$consulta->id,$participante->id_su,'2'])}}">2</a>
                                    <a class="btn btn-danger" href="{{url('cambiar-premio',[$consulta->id,$participante->id_su,'3'])}}">3</a>
                                
                                @elseif($consulta->lugar==2)
                                    <a class="btn btn-warning" href="{{url('cambiar-premio',[$consulta->id,$participante->id_su,'1'])}}">1</a>
                                    <a class="btn btn-primary" href="{{url('cambiar-premio',[$consulta->id,$participante->id_su,'2'])}}" disabled>2</a>
                                    <a class="btn btn-danger" href="{{url('cambiar-premio',[$consulta->id,$participante->id_su,'3'])}}">3</a>
                               
                                @elseif($consulta->lugar==3)
                                    <a class="btn btn-warning" href="{{url('cambiar-premio',[$consulta->id,$participante->id_su,'1'])}}">1</a>
                                    <a class="btn btn-primary" href="{{url('cambiar-premio',[$consulta->id,$participante->id_su,'2'])}}">2</a>
                                    <a class="btn btn-danger" href="{{url('cambiar-premio',[$consulta->id,$participante->id_su,'3'])}}" disabled>3</a>
                                @endif
                            @else
                                <a class="btn btn-warning" href="{{url('asignar-premio',[$participante->id_su,'1'])}}">1</a>
                                <a class="btn btn-primary" href="{{url('asignar-premio',[$participante->id_su,'2'])}}">2</a>
                                <a class="btn btn-danger" href="{{url('asignar-premio',[$participante->id_su,'3'])}}">3</a>  
                            @endif      
                        </td>
                    </tr>
                @empty
                	<tr>
                		<td colspan="4" align="center">
                            {{trans('mensajes.todavia-no-hay-participantes')}}
                        </td>
                    </tr>
				@endforelse

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
/*


var dataParticipantes = {!! $dataParticipantes !!};

    vm = new Vue({
        el: "#app",
        data: {
            participantes: dataParticipantes
        },
        methods: {
        	asignarPremio: function(participantes,lugar) {

                axios.post('asignar-premio/'+participantes.sorteo_id+'/'+participantes.sorteo_id+'/'+lugar).then(function (response) {
                    console.log("respuesta ganador");
                    console.log(response.data);
         
                })
            }
        }
     });*/
 </script>
@endsection