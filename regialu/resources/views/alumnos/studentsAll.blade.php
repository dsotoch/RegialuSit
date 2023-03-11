@extends('base')
@section('stilos')
<link rel="stylesheet" href="{{ asset('alumnos/css/estilo.css') }}"> 
@endsection
@section('contenido')
<div class="row">
    <div class="col-4">
        <h5 class="page-title">Lista de Alumnos en General Registrados</h5>

    </div>
    <div class="col-5">
<label style="border-radius: 10px" for="institucion" class="form-control btn-info">Filtrar por Institución</label>
       <select style="border-radius: 10px" class="form-control" aria-label="Default select example" id="institution"
            title="Solo Instituciones Activas">
            <option selected value="0">Seleccione una Institución</option>
            @foreach($institucions as $n)
        
            <option value="{{$n->id}}">{{$n->nombre}}</option>

            @endforeach

        </select>
    </div>
    <div class="col-3">
        <nav aria-label="breadcrumb" id="routes">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Alumnos</li>

            </ol>
        </nav>
    </div>
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



                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

        
        </div>
    </div>
</div>
@endsection
@section('javascript')

<script src="{{ asset('melody/js/data-table.js' )}}"></script>
<script src="{{ asset('alumnos/js/todoalumnos.js') }}"></script>

@endsection