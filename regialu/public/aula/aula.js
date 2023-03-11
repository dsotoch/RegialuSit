import { showWarningToast } from "/melody/js/toastDemo.js";
console.log("trabajando aula.js");
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
$(document).on('change', '#institucion', function () {
    var nivel = $("#institucion option:selected").val();
    if (nivel == '0') {
        showWarningToast('Selecciona una Opción Valida');
        $("#btnsave").attr("disabled", true);

    } else {
        $("#btnsave").attr("disabled", false);

    }
});
$(document).on('change', '#nivel', function () {
    var nivel = $("#nivel option:selected").val();
    if (nivel == '0') {
        showWarningToast('Selecciona una Opción Valida');
        $("#btnsave").attr("disabled", true);

    } else {
        $("#btnsave").attr("disabled", false);

    }
});
function resetearValores() {
    var id_institu = $("#institucion").val(0);
    var seccion = $("#seccion").val("");
    var grado = $("#grado").val("");
    var nivel = $("#nivel").val(0);
    $("#btnsave").attr("disabled", true);

}
$(document).on('click', '#btnsave', function (e) {
    e.preventDefault();
    var id_institu = $("#institucion option:selected").val();
    var institucion = $("#institucion option:selected").text();
    var seccion = $("#seccion").val();
    var grado = $("#grado").val();
    var nivel = $("#nivel option:selected").val();
    var nivelo = $("#nivel option:selected").text();
    var cantidad = parseInt($("#cantidad_label").val());
    var tabla = $("#mitable");
    try {
        $.ajax({
            type: "get",
            dataType: "json",
            url: "/Aulas/GuardarAula",
            data: { 'institucion': id_institu, 'seccion': seccion, 'grado': grado, 'nivel': nivel, _token: csrftoken },
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                if (response.aula == 'error') {
                    error("Hubo un Error al tratar de Registrar" + response.ex);
                } else {
                    tabla.find('tr:eq(1)').remove();
                    tabla.prepend('<tr> <td>' + institucion + '  </td><td>' + response.aula.grado + ' </td> <td>' + response.aula.seccion + '  </td><td>' + nivelo + ' </td> </tr>');
                    $("#cantidad_label").val(cantidad + 1);
                    confirmation("Aula Registrada Correctamente");
                    resetearValores();

                }
            }, error: function (param) {
                alert(param);
            }
        });
    } catch (error) {
        console.log(error);
    }
});
$(document).on('click', "#todas_aulas", function () {
    window.location.href = '/Aulas/TodasAulas';
});
$(document).on('change', '#select-institucion', function () {
    var id = $("#select-institucion option:selected").val();
    if (id == '0') {
        window.location.reload();
    } else {
        $.ajax({
            url: '/Aulas/InstitucionSeleccionada/' + id + '/',
            type: 'GET',
            success: function (response) {
                $("#chosen").html(response);
            }
        });
    }

});
$(document).on('click', '.btn-delete', function () {
    var row = $(this).closest('tr');
    const table = $("#order-listing").DataTable();
    let index = $("#order-listing").DataTable().row(row).index();

    var id = table.row(row).data()[0]
    var grado = table.row(row).data()[2];
    var seccion = table.row(row).data()[3];
    var institucion = table.row(row).data()[1];
    var nivel = table.row(row).data()[4];

    swal({
        title: '¿Seguro de Eliminar La Aula?',
        text: institucion + " " + grado + seccion + " " + nivel,
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
            $.ajax({
                type: "get",
                url: "/Aulas/EliminarAula/" + id + "/",
                data:{_token:csrftoken},
                success: function (response) {
                    if (response.response == 'success') {
                        $("#order-listing").DataTable().row(index).remove().draw();

                        confirmation("Registro Eliminado Correctamente");

                    } else {
                        error("Error al Eliminar ...Intentalo Nuevamente");
                    }
                }
            });
        }
    });
});
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
            var id = data[0];

            $.ajax({
                type: "get",
                url: "/Aulas/EstadoAula/" + id + "/",
                data: {_token:csrftoken},
                dataType: "json",
                ContentType: 'application/json;charset=utf-8',
                success: function (response) {
                    if (response.response != 'error') {
                        let column = $(row.find('td')[5]);
                        let nuevovaloractivo = $('<input style="border: none;text-align:center;" type="text" class="btn-success" disabled value = "Activo" > ')
                        let nuevovalorinactivo = $('<input style="border: none;text-align:center;" type="text" class="btn-danger" disabled value = "Inactivo" > ')

                        if (response.response == 'Activo') {

                            column.empty().append(nuevovaloractivo);

                        } else {
                            column.empty().append(nuevovalorinactivo);

                        }

                        confirmation("Estado Cambiado Correctamente");



                    } else {
                        error("Error al Cambiar de Estado...Intentalo Nuevamente");
                    }



                }, error: function (error) { alert(error.response) }
            });
        }
    });


});
$(document).on('change', '#nivelmodal', function () {
    let sel = $("#nivelmodal option:selected").val();
    if (sel == '0') {
        showWarningToast("Seleccione una Opción Valida");
        $("#editar").prop('disabled', true);

    } else {
        $("#editar").prop('disabled', false);
    }
});
$(document).on('click', '.btn-edit', function () {
    let row = $(this).closest('tr');
    let id = $(row.find('td')[0]).text();
    var institucion = $(row.find('td')[1]).text();
    var grado2 = $(row.find('td')[2]).text();
    var seccion2 = $(row.find('td')[3]).text();
    var nivel2 = $(row.find('td')[4]).text().toUpperCase();

    $("#aulamodal").val(id);

    $("#institucionmodal").val(institucion);
    $("#gradomodal").val(grado2);
    $("#seccionmodal").val(seccion2);
    $("#nivelmodal option:contains('" + nivel2 + "')").prop("selected", true);
    $("#editar").prop('disabled', false);
    //COLUMNAS

    $(document).on('click', '#editar', function () {
        let id = $("#aulamodal").val();
        let grado = $("#gradomodal").val().toUpperCase();
        let seccion = $("#seccionmodal").val().toUpperCase();
        let nivel = $("#nivelmodal option:selected").val();

        var data = { 'grado': grado, 'seccion': seccion, 'nivel': nivel ,_token:csrftoken};

        $.ajax({
            type: "get",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            url: "/Aulas/EditarAula/" + id + "/",
            data: data,
            success: function (response) {
                if (response.response != 'error') {

                    $(row.find('td')[2]).text((response.response.grado).toUpperCase());
                    $(row.find('td')[3]).text((response.response.seccion).toUpperCase());
                    $(row.find('td')[4]).text(response.response.nivel);
                    confirmation("Registro Modificado Correctamente");
                } else {
                    alert("Error al Modificar Registro..Intentalo Nuevamente");
                }
            }
        });
    });

});

function confirmation(text) {
    swal({
        title: "Felicitaciones",
        icon: "success",
        text: text,
        value: true,
        confirmButtonText: "Ok",
    }).then((value) => {
    });
}
function confirmation2(text) {
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