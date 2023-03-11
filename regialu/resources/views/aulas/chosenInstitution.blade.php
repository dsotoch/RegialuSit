<div class="card">
    <div class="card-body">
        <table id="order-listing" class="table table-striped">
            <thead>
                <tr>
                    <th hidden>id</th>
                    <th>Institución</th>
                    <th>Grado</th>
                    <th>Sección</th>
                    <th>Nivel</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $n)
                <tr>
                    <td hidden>{{$n['id']}}</td>
                                    <td>{{$n['institucion']}}</td>
                                    <td>{{$n['grado']}}</td>
                                    <td>{{$n['seccion']}}</td>
                                    <td>{{$n['tipo']}}</td>
                    <td>
                        @if($n['estado']=='Activo')
                        <input style="border: none;text-align:center;" type="text" class="btn-success" disabled
                            value="{{$n['estado']}}">
                        @else
                        <input style="border: none;text-align:center;" type="text" class="btn-danger" disabled
                            value="{{$n['estado']}}">
                        @endif
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-4">
                                <button style="border: none;" type="button" class="btn-edit" title="Editar" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    <i class="fas fa-edit"></i> </button>
                            </div>
                            <div class="col-4 ">
                                <button style="border: none;" type="button" class="btn-delete" title="Eliminar"><i
                                        class="fas fa-times-circle"></i></button>
        
                            </div>
                            <div class="col-4">
                                <button style="border: none;" class="btn-estado" type="button" 
                                    title="Click para Cambiar Estado"><i class="fas fa-history"></i></button>
                            </div>
                        </div>
                    </td>
        
        
                </tr> 
                @endforeach
        
        
        
            </tbody>
        </table>
    </div>
</div>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <center>
            <div class="modal-header" >
                <h5 style="width:100% ;background-color: brown;color: white;" class="modal-title" id="exampleModalLongTitle">
                    Actualizar
                    Aula</h5>
            </div>
        </center>
        <div class="modal-body">
            <form style="border:  brown solid;" Acción=" ">
                @csrf
                <div class="mb-3 ">
                    <label style="color: black;" for="nombremodal" class="form-label">Institución</label>
                    <input type="text " name="nombremodal"
                        placeholder="" class="form-control"
                        id="institucionmodal" aria-describedby="textHelp" disabled>
                </div>
                <div class="mb-3 ">
                    <label  style="color: black;" for="nombremodal" class="form-label">Grado</label>
                    <input type="text " name="nombremodal"
                        placeholder="Ingrese el Grado " class="form-control"
                        id="gradomodal" aria-describedby="textHelp" required>
                </div>
                <div class="mb-3 ">
                    <label  style="color: black;" for="nombremodal" class="form-label">Sección</label>
                    <input type="text " name="nombremodal"
                        placeholder="Ingrese la Sección" class="form-control"
                        id="seccionmodal" aria-describedby="textHelp" required>
                </div>
                <div class="mb-3"><label style="color: black;" for="tipomodal" class="form-label ">Nivel</label>
                    <select style="width:100%; " name="tipomodal" class="form-control"
                        id="nivelmodal" required>
                        <option value="0" selected>Seleccione una Opción</option>
                        <option value="Primaria">PRIMARIA</option>
                        <option value="Secundaria">SECUNDARIA</option>
                        <option value="Superior">SUPERIOR</option>
                        <option value="Afianzamiento">AFIANSIAMIENTO</option>
                        <option value="Otro">OTRO</option>
                    </select>
                </div>
                <input type="hidden" name="aulamodal" id="aulamodal">
                

            </form>

        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" id="editar"
                title="Actualizar Institución" disabled><i
                    class="fas fa-edit ">Actualizar</i></button>
        </div>
    </div>
</div>
</div>

<script src="{{ asset('melody/js/data-table.js') }} "></script>
