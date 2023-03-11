@extends('base') 
@section('stilos')
<link rel="stylesheet" href="{{ asset('horario/horario.css')}}">
@endsection
@section('contenido')

<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <h3 class="page-title">Asignaciones de Horarios a las Aulas</h3>
        </div>
    </div>
    <div class="dropdown-divider"></div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset('imagenes/horario.jpg') }}" class="card-img-top" alt="profile image">
                    <input type="hidden" name="idHorario" id="idHorario" value="{{$horario['id']}}">
                    <h4>{{$horario['area']}}</h4>
                    <p class="btn-info btn-sm">{{$horario['estado']}}</p>
                    <p ><h6>{{$horario['dia']}}</h6></p>
                    <p class="mt-4 card-text">
                        Aqui Puedes Asignar las Aulas que pertenescan a este Horario..
                    </p>

                    <button class="btn btn-success btn-icon-text" data-toggle="modal" data-target="#exampleModal"><i
                            class="fa fa-play-circle btn-icon-prepend"></i>Mostrar Aulas</button>
                    <div class="border-top pt-3">
                        <div class="row">
                            <div class="col-4">
                                <h6>{{$cantidad}}</h6>
                                <p>Aulas Asignadas</p>
                            </div>
                            <div class="col-4">
                                <h6>{{$horario['horainicio']}}</h6>
                                <p>Hora de Inicio</p>
                            </div>
                            <div class="col-4">
                                <h6>{{$horario['horafin']}}</h6>
                                <p>Hora de Termino</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Aulas Asignadas</h4>
                    <input type="hidden" name="" id="aula-id" value="{{$aulas['id']}}">
                    <div class="input-container">
                        <div class="row">
                            <input style='border:none;margin:5px;' width="100%" type="button"
                                class='btn btn-info col-12 details'
                                value="{{$aulas['grado']}}{{$aulas['seccion']}}-{{$aulas['nivel'] }}" id="{{$aulas['id']}}"
                                data-target="#exampleModal2" data-toggle="modal" title="Ver Detalles ">

                        
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Modal starts -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header btn-info">
                    <h3 style="color: white;" class="page-title" id="exampleModalLabel">Panel de Registro de Horarios a
                        Aulas</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;font-weight: bold;">X</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid ">

                        <div class="row">
                            <div class="col-7" style="border: black solid;">

                                <div class="card">
                                    <center>
                                        <h3 class="page-title">Lista de Aulas Activas</h3>
                                    </center>
                                    <div class="dropdown-divider"></div>
                                    <div class="card-body">
                                        <div class="table-responsive col-12">
                                            <table id="order-listing" class="table table-striped col-12">
                                                <thead>
                                                    <tr>
                                                        <th>Acción</th>
                                                        <th hidden>id</th>
                                                        <th>Institución</th>
                                                        <th>Grado</th>
                                                        <th>Sección</th>
                                                        <th>Nivel</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data as $s)
                                                    <tr>
                                                        <td><button style="border: none;" title="Agregar"
                                                                id="btn-elegido"><i class="fas fa-location-arrow"
                                                                    title="Agregar"></i></button>
                                                        <td hidden>{{$s['id']}}</td>
                                                        <td>{{$s['institucion']}}</td>
                                                        <td>{{$s['grado']}}</td>
                                                        <td>{{$s['seccion']}}</td>
                                                        <td>{{$s['nivel']}}</td>
                                                    </tr> 

                                                    @endforeach

                                                </tbody>
                                            </table>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Horario</h4>
                                        <div class="row">
                                            <div class="col-3">
                                                <h6>{{$horario['area']}}</h6>
                                            </div>
                                            <div class="col-2">
                                                <h6>{{$horario['turno']}}</h6> </div>
                                                <div class="col-2">
                                                    <h6>{{$horario['dia']}}</h6> </div>
                                            <div class="col-2">
                                                <h6>{{$horario['horainicio']}}</h6>
                                                <p>Hora de Inicio</p>
                                            </div>
                                            <div class="col-3">
                                                <h6>{{$horario['horafin'] }}</h6>
                                                <p>Hora de Termino</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="dropdown-divider"></div>

                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Aulas Elegidas</h4>
                                        <div class="row" id="row2">

                                        </div>

                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <div style="padding: 15px;">
                                        <center><button class="btn btn-danger btn-icon-text" id="btn-asignar"><i
                                                    class="fa fa-upload btn-icon-prepend"></i>Asignar</button></center>

                                    </div>
                                </div>
                            </div>
                        </div>





                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header btn-info">
                    <h3 style="color: white;" class="page-title" id="exampleModalLabel">Detalles del Aula</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;font-weight: bold;">X</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row ">

                        <div class="card col-12">
                            <img src="{{asset('imagenes/aulas.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title" id="institucion">Card title</h5>
                                <ul>
                                    <li>
                                        <span>Grado</span>
                                        <h5 id="grado"></h5>
                                    </li>
                                    <li>
                                        <span>Sección</span>
                                        <h5 id="seccion"></h5>
                                    </li>
                                    <li> <span>Nivel</span>
                                        <h5 id="nivel"></h5>
                                    </li>
                                    <li> <span>Estado</span>
                                        <h5 id="estado"></h5>
                                    </li>
                                    <input type="hidden" name="idAula" id="idAula">


                                </ul>
                               
                            </div>
                        </div>





                    </div>
                </div>

            </div>
        </div>
    </div>

</div> 
@endsection
@section('javascript')
<script src="{{ asset('melody/js/toastDemo.js ')}}" type="module"></script>
<script src="{{asset('melody/js/data-table.js')}}"></script>
<script src="{{ asset('horario/horario.js')}}" type="module"></script>
@endsection