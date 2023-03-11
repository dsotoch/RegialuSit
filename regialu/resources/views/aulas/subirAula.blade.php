@extends('base') 
@section('stilos')
<link rel="stylesheet" href="{{asset( 'aula/estilo.css' )}}"> 
@endsection
@section('contenido')
<br>
<div class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                <h3 class="page-title">Registrar Aulas</h3>
            </div>
        </div>
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm">
            <form>
               @csrf
                <div class="mb-3" id="divtitle">
                    <div class="mb-3">
                        <label for="institucion" class="form-label">Institución donde Pertenece</label>

                    </div>
                    <div class="mb-3"><select class="form-control" aria-label="Default select example" id="institucion"
                            required>
                            <option selected value="0">Seleccione una Opción</option>
                            @foreach($ins as $n)
                            <option value="{{$n->id}}">{{$n->nombre}}</option>
                           
                            @endforeach

                        </select></div>

                    <div class="mb-3">
                        <label for="exampleInputText1" class="form-label">Sección</label>
                        <input placeholder="Ingresa la Sección que pertenece la Aula" type="text" class="form-control"
                            id="seccion" name="seccion" aria-describedby="textHelp" onkeyup="mayus(this)" required>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText1" class="form-label">Grado</label>
                        <input placeholder="Ingresa el Grado que pertenece la Aula" type="number" class="form-control"
                            name="grado" id="grado" aria-describedby="textHelp" onkeyup="mayus(this)" required>
                    </div>
                    <div class="mb-3">
                        <label for="nivel" class="form-label">Nivel</label>
                        <select class="form-control" aria-label="Default select example" id="nivel">
                            <option selected value="0">Seleccione una Opción</option>
                            <option value="Primaria">PRIMARIA</option>
                            <option value="Secundaria">SECUNDARIA</option>
                            <option value="Superior">SUPERIOR</option>
                            <option value="Afianzamiento">AFIANSIAMIENTO</option>
                            <option value="Otro">OTRO</option>
                        </select>
                    </div>
                    <center>
                        <div class="mb-3">
                            <button class="btn btn-success" id="btnsave" disabled><i
                                    class="fas fa-upload" title="Completa todos los campos Para Registrar">Registrar</i></button>
                        </div>
                    </center>
                </div>


            </form>
        </div>
        <div class="col-sm">
            <div class="card " style="width: 18rem; ">
                <img src="{{asset( 'imagenes/aulas.jpg')}} " class="card-img-top "
                    alt="... ">
                <div class="card-body ">
                    <h5 class="card-title ">Cantidad de Aulas</h5>
                    <p class="text ">Actualmente Cuentas con un Total de
                        <input style="border: none;" class="cantidad" id="cantidad_label" value="{{$total}}" disabled> Aulas Registradas
                    </p>
                    <div class="d-grid ">
                        <button class="btn btn-success" type="button" title="Todas las Aulas" id="todas_aulas">Ver
                            Todas las Aulas Registradas</button>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<br>
<div class="content-wrapper">
    <center>
        <p
            style="color: white;font-size: 25px;font-family: Verdana, Geneva, Tahoma, sans-serif;background-color: green; ">
            Ultima Aula Registrada</p>
    </center>
    <table class="table table-bordered table-responsive-sm" id="mitable">
        <thead>
            <tr>
                <th scope="col ">Institución</th>
                <th scope="col ">Grado</th>
                <th scope="col ">Sección</th>
                <th scope="col ">Nivel</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aulas as $n)
            <tr>
                <td>
                    {{$n['institucion']}}
                </td>
                <td>{{$n['grado']}}</td>
                <td>{{$n['seccion']}}</td>
                <td>{{$n['nivel']}}</td>
            </tr>


            @endforeach

        </tbody>
    </table>

   @endsection
   @section('javascript')
    
    <script src="{{asset('melody/js/toastDemo.js')}}" type="module"></script>
    <script src="{{asset('aula/aula.js')}}" type="module"></script>
    <script>
        function mayus(e) {
            e.value = e.value.toUpperCase();
        }
    </script>
    @endsection