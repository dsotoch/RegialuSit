@extends('base')
@section('stilos')
<link rel="stylesheet" href="{{ asset('periodo/stilo.css')}}">
@endsection
@section('contenido')
<div class="row">
    <div class="col-6">
        <h5 class="page-title">Lista de Periodos</h5>
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="container-fluid">
    <div class="row pricing-table">
        <div class="col-md-4 grid-margin stretch-card pricing-card">
            <form action="">
                <div class="card border-primary border pricing-card-body">
                    <div class="card-body">

                        <h4 class="card-title">Descripción del Periodo</h4>

                        <input type="text" class="form-control" id="period-description" placeholder="Debe de ser Unico">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Fecha de Inicio</h4>
                        <p class="card-description">Haga clic para abrir el selector de fechas(Mes/Dia/Año)</p>
                        <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" id="start-date">
                            <span class="input-group-addon input-group-append border-left">
                                <span class="far fa-calendar input-group-text"></span>
                            </span>
                        </div>
                    </div>


                    <div class="card-body">
                        <h4 class="card-title">Fecha de Termino</h4>
                        <p class="card-description">Haga clic para abrir el selector de fechas(Mes/Dia/Año)</p>
                        <div id="datepicker-popup1" class="input-group date datepicker">
                            <input type="text" class="form-control" id="finish-date">
                            <span class="input-group-addon input-group-append border-left">
                                <span class="far fa-calendar input-group-text"></span>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-info btn-icon-text" id="period-save"><i
                                class="fas fa-upload btn-icon-prepend"></i>Registrar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8 grid-margin stretch-card pricing-card">
            <div class="card border-primary border pricing-card-body">
                    <div class="table-responsive">
                        <table class="table" id="order-listing">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th scope="col">Periodo</th>
                                    <th scope="col">Inicio</th>
                                    <th scope="col">Fin</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $periods as $n)

                                <tr>
                                    <td>{{$n->id}}</td>
                                    <td>{{$n->descripcion}}</td>
                                    <td>{{$n->fecha_inicio}}</td>
                                    <td>{{$n->fecha_fin}}</td>
                                    <td>
                                        @if($n->estado == "Activo" )
                                        <input style="border: none;text-align:center;" type="text" class="btn-success"
                                            disabled value="{{$n->estado}}">
                                        @else
                                        <input style="border: none;text-align:center;" type="text" class="btn-danger"
                                            disabled value="{{$n->estado}}">
                                       @endif
                                    </td>
                                    <td>
                                        <div class="row">

                                            <div class="col-6">
                                                <button style="border: none;" type="button" class="btn-delete"
                                                    title="Eliminar"><i class="fas fa-times-circle"></i></button>

                                            </div>
                                            <div class="col-6">
                                                <button style="border: none;" class="btn-estado" type="button"
                                                    title="Click para Cambiar Estado"><i
                                                        class="fas fa-history"></i></button>
                                            </div>
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
</div>

@endsection
@section('javascript')

<script src="{{ asset('melody/js/data-table.js')}}"></script>
<script src="{{ asset('melody/js/formpickers.js' )}}"></script>
<script src="{{ asset('periodo/period.js')}}" type="module"></script>


@endsection