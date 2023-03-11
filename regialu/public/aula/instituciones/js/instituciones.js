import { showWarningToast } from "/melody/js/toastDemo.js";
console.log("trabajando instituciones.js");
//const listarInstituciones = async() => {
//try {
//   const response = await fetch("./getInstituciones");
//   const data = await response.json();

//   if (data.message == "success") {
//       let datos = ``;
//       data.instituciones.forEach((instituciones) => {
//          datos += `<tr> <td> ${instituciones.idInstitucion}  </td> <td> ${instituciones.nombre}  </td> <td> ${instituciones.tipo}  </td>  <td> ${instituciones.direccion}  </td> <td> <label class="badge badge-info"> ${instituciones.estado}</label></td> <td>  <button class="btn btn-outline-primary" title="Cambiar Estado"> Cambiar </button> </td> </tr>`;
//       });

$(document).on('click', '.btn-estado', function (evento) {
    evento.preventDefault();
    swal({
        title: '¿Seguro de Cambiar de Estado?',
        text: "Puedes Cambiar de estado las veces que quieras",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Great',
        buttons: {
            cancel: {
                text: "Cancelar",
                value: null,
                visible: true,
                className: "btn btn-danger",
                closeModal: true,
            },
            confirm: {
                text: "OK",
                value: true,
                visible: true,
                className: "btn btn-primary",
                closeModal: true
            }
        }
    }).then((value) => {
        if (value == true) {
            const table = $("#order-listing").DataTable();
            var row = $(this).closest('tr');
            var data = table.row(row).data();
            var id = data[0].trim();

            $.ajax({
                type: "get",
                url: "/Instituciones/EstadoInstitucion/" + id + "/",
                data: { _token: csrftoken },
                dataType: "json",
                ContentType: 'application/json;charset=utf-8',
                success: function (response) {
                    if (response.response == 'success') {
                        confirmation("Estado Cambiado Correctamente");

                    } else {
                        error("Error al Cambiar de Estado...Intentalo Nuevamente" + response.ex);
                    }



                }, error: function (error) { alert(error.response) }
            });
        }
    });


});
$(document).on('click', '.btn-delete', function () {
    try {
        var table = $("#order-listing").DataTable();
        var row = $(this).closest("tr");
        let index = $("#order-listing").DataTable().row(row).index();
        var name = table.row(row).data()[2];
        swal({
            title: '¿Seguro de Eliminar el Registro?',
            text: name,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f51b5',
            cancelButtonColor: '#ff4081',
            confirmButtonText: 'Great',
            buttons: {
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true,
                },
                confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                    className: "btn btn-primary",
                    closeModal: true
                }
            }
        }).then((value) => {
            if (value == true) {
                var id = table.row(row).data()[0];
                $.ajax({
                    type: "get",
                    url: "/Instituciones/EliminarInstitucion/" + id + "/",
                    data: { _token: csrftoken },
                    success: function (response) {
                        if (response.response == 'success') {
                            $("#order-listing").DataTable().row(index).remove().draw();
                            confirmation("Registro Eliminado Correctamente");
                        } else {
                            error("Ocurrio un Error al eliminar el registro..Intentalo Nuevamente" + response.ex);
                        }
                    }, error: function (res) {
                        alert(res.response);
                    }
                });
            }


        });
    } catch (error) {
        alert(error);

    }

});
$(document).on('click', '.btn-edit', function (e) {
    e.preventDefault();
    try {
        const table = $("#order-listing").DataTable();
        var tipo = $("#tipo");
        var direccion = $("#direccion");
        var row = $(this).closest('tr');
        var name = table.row(row).data()[3];
        var tipo = table.row(row).data()[4];
        var id = table.row(row).data()[0];
        var direccion = table.row(row).data()[5];
        var period = table.row(row).data()[1];
       
        $("#nombremodal").val(name);
        $("#idinstitucionmodal").val(id);
        $("#direccionmodal").val(direccion);
        $("#periodmodal option[value='" + period + "']").attr("selected", true);
        $("#tipomodal option[value='" + tipo + "']").attr("selected", true);
        $("#editar").prop('disabled', false);


    } catch (error) {
        alert(error);

    }

});
$(document).on('click', "#editar", function (evt) {
    evt.preventDefault();
    try {
        var name = $("#nombremodal").val();
        var direc = $("#direccionmodal").val();
        var tipo = $("#tipomodal option:selected").val();
        var id = $("#idinstitucionmodal").val();
        var period = $("#periodmodal option:selected").val();

        if (tipo == '0' || period == '0') {
            showWarningToast("Selecciona una Opción Valida");

        } else {
            var data = { 'nombre': name, 'tipo': tipo, 'direccion': direc,_token:csrftoken };
            $.ajax({
                type: "get",
                url: "/Instituciones/ModificarInstitucion/" + id + "/" + period + "/",
                data: data,
                dataType: "json",
                ContentType: 'application/json;charset=utf-8',
               
                success: function (response) {
                    if (response.response == true) {

                        confirmation("Registro Actualizado Correctamente");
                    } else {
                        error("Error al Editar Registro...Intentalo Nuevamente"  + response.ex);
                    }
                }
            });

        }




    } catch (error) {
        alert(error);
    }
});


function getCookie(name) {
    let cookieValue = null;
    if (document.cookie && document.cookie !== "") {
        const cookies = document.cookie.split(";");
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            // Does this cookie string begin with the name we want?
            if (cookie.substring(0, name.length + 1) === name + "=") {
                cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                break;
            }
        }
    }
    return cookieValue;
}
const csrftoken = getCookie("csrftoken");
$("#tipo").on("change", function () {
    var tipo = $("#tipo option:selected").val();
    if (tipo == "0") {
        showWarningToast("Selecciona Una Opción Valida");
        Desactivarboton();
    } else {
        Activarboton();
    }
});

function Activarboton() {
    var button = $("#guardar");
    button.prop("disabled", false);
    button.prop("title", "Registrar Institución");
}

function Desactivarboton() {
    var button = $("#guardar");
    button.prop("disabled", true);
    button.prop("title", "Rellena todos los campos para Activar");
}
$("#guardar").on("click", function () {
    var table = $("#order-listing").DataTable();
    var tipo = $("#tipo option:selected").val();
    var period = $("#period option:selected").val();

    var nombre = $("#nombre").val();
    var direccion = $("#direccion").val();
    if (nombre == "" || direccion == "" || tipo == "0" || period == '0') {
        showWarningToast("Completa los campos Requeridos");
    } else {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "/Instituciones/CrearInstitucion",
            data: {
                nombre: nombre,
                tipo: tipo,
                direccion: direccion,
                period: period, _token: csrftoken
            },
            ContentType: 'application/json;charset=utf-8',
            success: function (response) {
                if (response.respuesta == false) {
                    error('Error al Crear Registro :' + response.ex);

                } else {
                    confirmation("Institución Registrada Correctamente");

                }
            },
            error: function (error) {
                error(error);
            },
        });
    }
});

function confirmation2(text) {
    swal({
        title: "Felicitaciones",
        icon: "success",
        text: text,
        confirmButtonText: "Ok",
    }).then((value) => {
    });
}

function confirmation(text) {
    swal({
        title: "Felicitaciones",
        icon: "success",
        text: text,
        value: true,
        confirmButtonText: "Ok",
    }).then((value) => {
        window.location.reload();
    });
}
function error(text) {
    swal({
        title: "ERROR",
        icon: "error",
        text: text,
        value: true,
        confirmButtonText: "Ok",
    }).then((value) => {
    });
}








