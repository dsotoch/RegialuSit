@extends('base')
@section('stilos')
<link rel="stylesheet" href="{{asset('alumnos/css/estilo.css') }}"> 
@endsection
@section('contenido')
<div class="row pricing-table" style="background-color: white">
    <div class="col-md-12 grid-margin stretch-card card-body"><div class="col-md-3 grid-margin card-body">
        <h5 class="page-title">Lista de Alumnos Registrados de la Institución {{$institutions->nombre}}</h5>
        <input type="hidden" name="idInstitucion" id="idInstitucion" value="{{$institutions->id}}">
    </div>

    <div class="col-6 grid-margin card-body">

        <select class="form-control" aria-label="Default select example" id="institution"
            title="Solo Instituciones Activas">
            <option value="{{$institutions->id}}">{{$institutions->nombre}}</option>

        </select>
        <br>


        <div>
            <button id="btn-newStudent" class=" btn btn-success btn-icon-text" data-toggle="modal"
                data-target="#exampleModal" title="Click para Asignar Nuevo Alumno"> <i class="fas fa-plus btn-icon-prepend"></i>
                Nuevo
                Alumno</button>
        </div>

        </center>
    </div>
    <div class="col-3 grid-margin card-body">
        <nav aria-label="breadcrumb" id="routes">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('students_all') }}">Alumnos</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$institutions->nombre}}</li>


            </ol>
        </nav>
    </div></div>
</div>
<div class="dropdown-divider"></div>

<div class="container-fluid" style="background-color: white;">
    <div class="row">
        <div class="col-12">

            <div class="table-responsive">
                <table class="table" id="order-listing">
                    <thead>
                        <tr>
                            <th hidden scope="col">Id</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Grado</th>
                            <th scope="col">Aula</th>
                            <th scope="col">Acción</th>



                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $n)
                        <tr>
                            <td hidden>{{$n['id']}}</td>
                            <td>{{$n['apellidos']}}</td>
                            <td>{{$n['nombres']}}</td>
                            <td>{{$n['grado']}}</td>
                            @if($n['seccion']=="")
                            <td>Sin Asignar</td>
                            @else
                            <td>{{$n['aula-gr']}} {{$n['aula-se']}} {{$n['aula-nivel']}} {{$n['institucion']}}</td>
    
                            @endif
    
                            <td>
                                <div class="row">
                                    <div class="col-6">
                                        <button style="border: none;" title="Eliminar Alumno"
                                            id="btn-delete-institution"> <i class="fas fa-trash"></i> </button>
                                    </div>
                                    <div class="col-6"><button style="border: none;" title="Editar Alumno"
                                            id="editaralumno"> <i class="fas fa-edit"></i>
                                        </button></div>
                                </div>
                            </td>



                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="div-title">

                <h5 class="modal-title title" id="exampleModalLabel">Registrar Alumno de la Institución
                    {{$institutions->nombre}}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="" style="padding: 10px;">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos"
                        placeholder="Apellidos del Alumno" required>

                    <br>
                    <label for="nombres" class="from-label">Nombres</label>
                    <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres del Alumno"
                        required>

                    <br>
                    <label for="grado" class="form-label">Grado</label>
                    <input type="text" class="form-control" name="grado" id="grado" placeholder="Grado del Alumno"
                        required>

                    <br>
                    <label for="aula">Aula</label>
                    <select class="form-control classroom_select" aria-label="Default select example" id="selectAula">
                        <option selected value="0">Seleccione una Aula</option>
                        @foreach($aulas as $n)
                        <option selected value="{{$n->id}}">{{$n->grado}} {{$n->seccion}}  {{$n->nivel}} </option>


                        @endforeach
                    </select>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-icon-text" id="btn-save-alumno"><i
                        class="fas fa-upload btn-icon-prepend"></i>Grabar Alumno</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="div-title">

                <h5 class="modal-title title" id="exampleModalLabel">Actualizar Alumno de la Institución
                    {{$institutions->nombre}}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="" style="padding: 10px;">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidosmodal" id="apellidosmodal"
                        placeholder="Apellidos del Alumno" required>

                    <br>
                    <label for="nombres" class="from-label">Nombres</label>
                    <input type="text" class="form-control" name="nombresmodal" id="nombresmodal"
                        placeholder="Nombres del Alumno" required>
                    <input type="hidden" id="idmodal">



                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-icon-text" id="btn-edit-institution"><i
                        class="fas fa-upload btn-icon-prepend"></i>Actualizar Alumno</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')

<script src="{{ asset('melody/js/data-table.js' )}}"></script>
<script src="{{ asset('alumnos/js/todoalumnos.js')}}"></script>

@endsection
