@extends('base')
@section('stilos')
<link rel="stylesheet" href="{{ asset('alumnos/css/estilo.css')}}">
@endsection
@section('contenido')

<div class="row">
    <div class="col-8">
        <h5 class="page-title">Subir Alumnos en General en Formato Excel</h5>

    </div>
    
    <div class="col-4">
        <nav aria-label="breadcrumb" id="routes">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Alumnos</li>

            </ol>
        </nav>
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('imagenes/students.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="text">Actualmente Cuentas con un Total de
                        <input class="cantidad" id="amount" value="{{$cantidadAlumnos}}  Alumnos Registrados" disabled>
                    </p>
                    <div><a class="btn btn-success" href="{{ route('students_all') }}">Ver Todos los Alumnos</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">



            <form enctype="multipart/form-data">
@csrf                
<div class="card">
                    <div class="card-body">

                        <h4 class="card-title" id="titulo">Elegir Archivo Para Subir</h4>
                        <input type="file" name="archivoParaSubir" id="archivoParaSubir" class="form-control">

                    </div>
                    <div class="card-body">
                        <center> <button class="btn btn-info btn-icon-text" id="btn-save" type="button"> <i
                                    class="fas fa-upload btn-icon-prepend"></i>Subir</button>
                        </center>
                    </div>
                </div>

            </form>


        </div>
    </div>


  
</div>




@endsection
@section('javascript')

<script src="{{ asset('alumnos/js/todoalumnos.js') }}"></script>
@endsection