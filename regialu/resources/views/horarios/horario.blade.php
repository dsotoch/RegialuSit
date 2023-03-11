@extends('base') 
@section('stilos')
<link rel="stylesheet" href="{{ asset('horario/horario.css') }}"> @endsection
@section('contenido')

<div class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <h3 class="page-title">Lista de Horarios</h3>
                <div class="dropdown-divider"></div>
                <button data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary">Nuevo
                    Registro</button>


            </div>
            <div class="col-6">
                <p class="text">Actualmente Cuentas con un Total de
                    <span><input style="border: none;" class="cantidad" id="cantidad_areas" value="{{$total}}"
                            disabled></span> Horarios Registrados
                </p>
            </div>

        </div>
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="container-fluid">
    <div class="row">

        <div class="col-12">
            <div class="table-responsive" id="chosen">
                <table id="order-listing" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Area</th>
                            <th>Turno</th>
                            <th>Día</th>
                            <th>HoraInicio</th>
                            <th>HoraFin</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $n)
                        <tr>
                            <td>{{$n['id']}}</td>
                            <td>{{$n['area']}}</td>
                            <td>{{$n['turno']}}</td>
                            <td>{{$n['dia']}}</td>
                            <td>{{$n['horainicio']}}</td>
                            <td>{{$n['horafin']}}</td>
                            <td>
                                @if($n['estado']== "Activo") 
                                <input style="border: none;text-align:center;" type="text" class="btn-success" disabled
                                    value="{{$n['estado']}}">
                                @else
                                <input style="border: none;text-align:center;" type="text" class="btn-danger" disabled
                                value="{{$n['estado']}}">
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-3">
                                        <button style="border: none;" type="button" class="btn-aula"
                                            title="Asignar Aulas" >
                                            <i class="fas fa-fighter-jet"></i>
                                        </button>
                                    </div>
                                    <div class="col-3">
                                        <button style="border: none;" type="button" class="btn-edit" title="Editar"
                                            data-toggle="modal" data-target="#exampleModalCenter2"><i
                                                class="fas fa-edit"></i></button>

                                    </div>

                                    <div class="col-3">
                                        <button style="border: none;" type="button" class="btn-delete"
                                            title="Eliminar"><i class="fas fa-times-circle"></i></button>

                                    </div>
                                    <div class="col-3">
                                        <button style="border: none;" class="btn-estado" type="button"
                                            title="Click para Cambiar Estado"><i class="fas fa-history"></i></button>
                                    </div>
                                </div>
                            </td>


                        </tr>
@endforeach


                    </tbody>
                </table>
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <center>
                                <div class="modal-header">
                                    <input
                                        style="width:100% ;background-color: brown;color: white;text-align: center;border: none;"
                                        class="modal-title" id="exampleModalLongTitle" value="Registrar Horario"
                                        disabled>

                                </div>
                            </center>
                            <div class="modal-body">
                                <form id="form">
@csrf

                                    <div class="mb-3">
                                        <label for="exampleInputText1" class="form-label">Turno</label>
                                        <select class="form-control" aria-label="Default select example" id="turno">
                                            <option selected value="0">Seleccione un Turno</option>
                                            <option value="Mañana">Mañana</option>
                                            <option value="Tarde">Tarde</option>
                                            <option value="Noche">Noche</option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputText1" class="form-label">Dia</label>
                                        <select class="form-control" aria-label="Default select example" id="dia">
                                            <option selected value="0">Seleccione un Dia</option>
                                            <option value="Lunes">Lunes</option>
                                            <option value="Martes">Martes</option>
                                            <option value="Miercoles">Miercoles</option>
                                            <option value="Jueves">Jueves</option>
                                            <option value="Viernes">Viernes</option>
                                            <option value="Sabado">Sabado</option>
                                            <option value="Domingo">Domingo</option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="area" class="form-label">Area</label>
                                        <select class="form-control" aria-label="area" id="area">
                                            <option selected value="0">Seleccione una Area</option>
                                            @foreach($area as $n)

                                            <option value="{{$n['id']}}">{{$n['descripcion']}}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="">Hora de Inicio</label>
                                        <div class="input-group date" id="timepicker-example"
                                            data-target-input="nearest">
                                            <div class="input-group" data-target="#timepicker-example"
                                                data-toggle="datetimepicker">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#timepicker-example" id="horainicio">
                                                <div class="input-group-addon input-group-append"><i
                                                        class="far fa-clock input-group-text"></i></div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Hora de Termino</label>
                                        <div class="input-group date" id="timepicker-example1"
                                            data-target-input="nearest">
                                            <div class="input-group" data-target="#timepicker-example1"
                                                data-toggle="datetimepicker">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#timepicker-example1" id="horafin">
                                                <div class="input-group-addon input-group-append"><i
                                                        class="far fa-clock input-group-text"></i></div>
                                            </div>

                                        </div>

                                    </div>

                                    <center>
                                        <div class="mb-3">

                                            <input type="button" class="btn btn-success" id="btnsave" value="Registrar"
                                                disabled>
                                        </div>
                                    </center>



                                </form>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <center>
                                <div class="modal-header">
                                    <input
                                        style="width:100% ;background-color: red;color: white;text-align: center;border: none;"
                                        class="modal-title" id="exampleModalLongTitle" value="Actualizar Horario"
                                        disabled>

                                </div>
                            </center>
                            <div class="modal-body">
                                <form id="form">
@csrf

                                    <div class="mb-3">
                                        <label for="exampleInputText1" class="form-label">Turno</label>
                                        <select class="form-control" aria-label="Default select example" id="turno2">
                                            <option selected value="0">Seleccione un Turno</option>
                                            <option value="Mañana">Mañana</option>
                                            <option value="Tarde">Tarde</option>
                                            <option value="Noche">Noche</option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputText1" class="form-label">Dia</label>
                                        <select class="form-control" aria-label="Default select example" id="dia2">
                                            <option selected value="0">Seleccione un Dia</option>
                                            <option value="Lunes">Lunes</option>
                                            <option value="Martes">Martes</option>
                                            <option value="Miercoles">Miercoles</option>
                                            <option value="Jueves">Jueves</option>
                                            <option value="Viernes">Viernes</option>
                                            <option value="Sabado">Sabado</option>
                                            <option value="Domingo">Domingo</option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="area2" class="form-label">Area</label>
                                        <select class="form-control" aria-label="area" id="area2">
                                            <option selected value="0">Seleccione una Area</option>
                                          @foreach($area as $n)

                                            <option value="{{$n['id']}}">{{$n['descripcion']}}</option>
                                            @endforeach

                                        </select>
                                    
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Hora de Inicio</label>
                                        <div class="input-group date" id="timepicker-example3"
                                            data-target-input="nearest">
                                            <div class="input-group" data-target="#timepicker-example3"
                                                data-toggle="datetimepicker">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#timepicker-example3" id="horainicio2">
                                                <div class="input-group-addon input-group-append"><i
                                                        class="far fa-clock input-group-text"></i></div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Hora de Termino</label>
                                        <div class="input-group date" id="timepicker-example2"
                                            data-target-input="nearest">
                                            <div class="input-group" data-target="#timepicker-example2"
                                                data-toggle="datetimepicker">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#timepicker-example2" id="horafin2">
                                                <div class="input-group-addon input-group-append"><i
                                                        class="far fa-clock input-group-text"></i></div>
                                            </div>

                                        </div>
                                        <input type="hidden" id="horariomodal">

                                    </div>

                                    <center>
                                        <div class="mb-3">

                                            <input type="button" class="btn btn-danger" id="btnsavemodal"
                                                value="Actualizar">
                                        </div>
                                    </center>



                                </form>

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
<script src="{{asset('melody/js/data-table.js') }}"></script>
<script src="{{asset('horario/horario.js') }}" type="module"></script>
<script src="{{asset('melody/js/formpickers.js')}}"></script>

@endsection