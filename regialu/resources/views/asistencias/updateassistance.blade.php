<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb  bg-success">
                <li class="breadcrumb-item"><a href="#" style="color: white;">Registrar Asistencia</a></button></li>
                <li class="breadcrumb-item active" aria-current="page">Modificar Asistencia del Aula : {{$aula}} </li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-12"><button id="cancel" class="btn btn-warning btn-icon-text"><i
                class="fas fa-reply btn-icon-prepend"></i>Registrar
            Asistencia </button></div>
</div>
<div class="dropdown-divider"></div>

<div class="row">
    <div class="col-3"><label for="">Fecha para Modificar Asistencia :</label> </div>
    <div class="col-3"><input type="date" name="" id="search-date"><button class="btn btn-search"
            title="click Para Buscar" id="search"> <i class="fas fa-search"></i></div>
    <div class="col-6"><label for="">Asistencia del Día :</label> <label for="" id="label-search"></label> </div>

</div>

<div class="table-responsive">
    <table class="table updatetable" id="order-listing2">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Nombres</th>
                <th scope="col">Aula</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>
<div class="dropdown-divider"></div>
<button style="float: right;" class="btn btn-success btn-icon-text" id="update-assistance"
    title="Click para Guardar Cambios"><i class="fas fa-undo btn-icon-prepend"></i>Actualizar Asistencia</button>

@section('javascript')
    
<script src="{{ asset('melody/js/toastDemo.js')}}" type="module"></script>

<script src="{{ asset('gestion/gestion.js')}}" type="module"></script>

<script src="{{ asset('melody/js/data-table.js')}}"></script>

@endsection