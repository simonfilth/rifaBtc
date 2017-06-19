@extends('layouts.app')

@section('content')
<div class="col-sm-8">
	<div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">{{trans('mensajes.sorteos')}}</h1>            
            <!-- <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol> -->
        </div>
    </div>
    <br>
    <div class="row">
        <div class="panel">
            <div class="text-success text-center">
                @if(Session::has('message'))
                    {{Session::get('message')}}
                @endif
            </div>               
            <div class="panel-body">

                {!! Form::open(['action' =>'SorteosController@mostrarSorteos', 'method' => 'GET','role'=>'search']) !!}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="input-group">
                              <input type="text" name="buscar" class="form-control" placeholder="{{trans('mensajes.buscar-sorteo')}}">
                              <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                              </span>
                            </div>
                            <br> 
                        </div>
                        <div class="col-sm-3">
                            <a href="{{url('agregar-sorteo')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{trans('mensajes.new')}} {{trans('mensajes.sorteo')}}</a>
                        </div>
 
                    </div>                  
                </div>
                {!! Form::close() !!}      
                
                <!-- <table id="table-responsive" class="table table-condensed table-striped sortable ">
                    <thead>
                        <th>#</th>
                        <th>{{trans('mensajes.fecha')}}</th>
                        <th>{{trans('mensajes.hora')}}</th>
                        <th>{{trans('mensajes.precio')}}</th>
                        <th>{{trans('mensajes.accion')}}</th>
                        <th>{{trans('mensajes.estado')}}</th>
                        
                    </thead>
                    <tbody>
                        @ forelse($sorteos as $sorteo)
                        <tr>
                            <td>{ !!$sorteo->id!!}</td>
                            <td>{ !!$sorteo->fecha_sorteo!!}</td>
                            <td>{ !!$sorteo->hora_sorteo!!}</td>
                            <td>{ !!$sorteo->precio_sorteo!!}</td>
                           
                            <td>
                                <a  class="btn btn-primary btn-xs" href="{ { url('mostrar-participantes', $ sorteo->id)}}" ><i class="fa fa-users"></i> Participantes</a>
                                <a  class="btn btn-primary btn-xs" href="{ { url('ver-sorteo', $sorteo->id)}}" ><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary btn-xs" href="{ { url('editar-sorteo', $sorteo->id)}}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-primary btn-xs" href="{ { url('eliminar-sorteo', $sorteo->id)}}" onclick="return confirm('¿Seguro que desea eliminar este sorteo?')"><i class="fa fa-trash"></i></a>
                            </td>
                            
                            <td>{ !!$sorteo->estado_sorteo!!}</td>
                            
                        </tr>
                        @ empty
                            <tr><td align="center" colspan="4">No se encontraron resultados</td></tr>
                        @ endforelse
                    </tbody>
                </table> -->

                <table id="table-responsive" class="table table-condensed table-striped sortable ">
                    <thead>
                        <th>#</th>
                        <th>{{trans('mensajes.precio')}}</th>
                        <th>{{trans('mensajes.accion')}}</th>
                        <th>{{trans('mensajes.estado')}}</th>
                        <th>{{trans('mensajes.comenzar-terminar')}}</th>
                        <th>{{trans('mensajes.activo-inactivo')}}</th>
                    </thead>
                    <tbody>
                    <template v-for="sorteo in sorteos">
                        <tr>
                            <td>@{{sorteo.id}}</td>
                            <td>@{{sorteo.precio_sorteo}}</td>
                            <td>
                                <a  class="btn btn-primary btn-xs" :href="'mostrar-participantes/'+sorteo.id" ><i class="fa fa-users"></i> {{trans('mensajes.participantes')}}</a>
                                <a  class="btn btn-primary btn-xs" :href="'ver-sorteo/'+sorteo.id" ><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary btn-xs" :href="'editar-sorteo/'+sorteo.id"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-primary btn-xs" :href="'eliminar-sorteo/'+sorteo.id" onclick="return confirm('¿Seguro que desea eliminar este sorteo?')"><i class="fa fa-trash"></i></a>
                            </td>
                            <td>@{{sorteo.estado_sorteo}}</td>
                            <template v-if="sorteo.estado_sorteo=='No realizado'">
                                <td>
                                    <a class="btn btn-success btn-block" @click.prevent="comenzarSorteo(sorteo)">
                                        {{trans('mensajes.comenzar')}}
                                    </a>
                                </td>
                            </template>
                            <template v-else-if="sorteo.estado_sorteo=='En Curso'">
                                <td>
                                    <a class="btn btn-danger btn-block" @click.prevent="terminarSorteo(sorteo)">
                                        {{trans('mensajes.terminar')}}
                                    </a>
                                </td>
                            </template>
                            <template v-else>
                                <td>
                                    <a class="btn btn-warning btn-block" @click.prevent="sorteoNoRealizado(sorteo)">
                                        {{trans('mensajes.no-realizado')}}
                                    </a>
                                </td>
                            </template>
                            <template v-if="sorteo.id==sorteo_en_curso">
                                <td>              
                                    {{trans('mensajes.activo')}}
                                </td>
                            </template>
                            <template v-else>
                                <td> 
                                    <a v-if="sorteo.estado_sorteo=='En Curso'" @click.prevent="activarSorteo(sorteo)"  class="btn btn-primary btn-block">
                                        {{trans('mensajes.activar')}}
                                    </a>
                                    <p v-else>
                                        {{trans('mensajes.inactivo')}}
                                    </p>             
                                    
                                </td>
                            </template>
                        </tr>
                    </template>
                        
                        <template v-if="sorteos.length == 0">
                            <tr>
                                <td colspan="6" align="center">
                                    {{trans('mensajes.todavia-no-hay-sorteos')}}
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                
                @include('layouts.partials.pagination')
                <!-- <pre>
                    @{{ $data }}  
                </pre> -->

            </div>
        </div>
        <!-- { !! $ sorteos->appends(Request::all())->render()!!}  -->
    </div>
</div>
<script type="text/javascript">
window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
// Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
// var dataSorteos = { !! $ dataSorteos !!};
const app = new Vue({
        el: "#app",
       data: {
             sorteos : [],
             sorteo_en_curso : '',
            pagination: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1,
            },
            offset: 4,
            formErrors: {},
            formErrorsUpdate: {}
        },
        computed: {
            isActived: function() {
                return this.pagination.current_page;
            },

            pagesNumber: function() {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        mounted() {
            // this.getVueSorteos();
            this.getVueSorteos(this.pagination.current_page);
            this.getVueSorteoEnCurso();
            // axios.get('cargar-sorteos').then(response => {this.sorteos = response.data})
            
        },
        methods: {
            getVueSorteos: function(page) {
                axios.get('cargar-sorteos?page='+page).then(function (response) {


                    /*console.log("sorteos");
                    console.log(response.data.data.data);*/
                    app.$nextTick(function() {
                        
                        this.sorteos = response.data.data.data;
                        this.pagination = response.data.pagination;

                    })
                });
            },
            getVueSorteoEnCurso: function() {
                axios.get('cargar-sorteo-en-curso').then(function (response) {
                    

                    
                    app.$nextTick(function() {
                        
                        this.sorteo_en_curso = response.data.data.sorteo_id;;
                        /*console.log("sorteos en curso");
                        console.log(response.data);
                        console.log(this.sorteo_en_curso);*/
                    })
                });
            },
            
            changePage: function(page) {
                this.pagination.current_page = page;
                this.getVueSorteos(page);
            },
            comenzarSorteo: function(sorteo) {

                axios.post('comenzar-sorteo-en-curso/'+sorteo.id).then(function (response) {
                    /*console.log("respuesta");
                    console.log(response.data);*/
                    app.getVueSorteos();
                    // this.sorteos = this.sorteos.filter(function (response) {
                        // if(item.id == sorteo.id){
                            // console.log("item");
                            // console.log(item);
                            // return item.id != id;
                        // }
                        
                    // });
                    // app.$nextTick(function() {
                    //     this.sorteos=response.data;
                    // })
                    /*toastr.options = {
                      "timeOut": "2000",
                    },*/
                    // toastr.success('Customer Added Successfully');
                    // alert('Customer Added Successfully');
                    /*$(this.$refs.add_customer_modal).on("hidden.bs.modal", that.hideAddCustomerModal());*/
                })
            },
            terminarSorteo: function(sorteo) {

                axios.post('terminar-sorteo-en-curso/'+sorteo.id).then(function (response) {
                    console.log("respuesta");
                    console.log(response);
                    app.getVueSorteos();
                })
            },
            sorteoNoRealizado: function(sorteo) {

                axios.post('sorteo-no-realizado/'+sorteo.id).then(function (response) {
                    console.log("respuesta");
                    console.log(response);
                    app.getVueSorteos();
                })
            },
            activarSorteo: function(sorteo,en_curso) {

                axios.post('activar-sorteo/'+sorteo.id).then(function (response) {
                    console.log("respuesta");
                    console.log(response);
                    app.getVueSorteos();
                    app.getVueSorteoEnCurso();
                })
            }

        }
     });

 </script>
@endsection