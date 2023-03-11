import { showDangerToast } from "/melody/js/toastDemo.js"
import { showSuccessToast } from "/melody/js/toastDemo.js"

$(document).on('click', '#register', function (e) {
    e.preventDefault();
    let dni = $("#dni").val();
    let nombres = $("#nombres").val();
    let apellidos = $("#apellidos").val();
    let email = $("#email").val();
    let pais = $("#pais option:selected").text();
    let password = $("#password").val();
    let check = $("#check").prop('checked');
    // Capturamos el valor del token

    if (dni == "" || nombres == "" || email == "" || password == "") {
        showDangerToast("Error,Completa todos los Campos");
    } else {
        if (check == false) {
            showDangerToast("Error,Acepta los Terminos Y Condiciones");

        } else {
            let data = {
                'dni': dni,
                'name': nombres,
                'surnames': apellidos,
                'email': email,
                'pais': pais,
                'password': password, _token: $('meta[name="csrf-token"]').attr('content'),

            };
            $.ajax({
                type: "POST",
                url: '/Login/GuardarUsuario',
                data: data,
                dataType: "json",

                success: function (response) {
                    if (response.value == 'dni_existe') {
                        error("El Documento de Identidad ya se encuentra Registrado");
                    } else {
                        if (response.value == 'email_existe') {
                            error("El email ya se encuentra Registrado");
                        } else {
                            if (response.value == true) {
                                confirmation3("BIENVENIDO..Usuario creado Correctamente", dni);
                            } else {
                                error("Hubo un Error .. Actualize la Pagina e Intentelo Nuevamente");
                                console.log(response.ex);

                            }

                        }
                    }

                }
            });
        }
    }
});
$(document).on('click', '#comprar', function (e) {
    e.preventDefault();
    let div = $(this).closest('div');
    let input = $(div.find('input')).val();
    let licencia = "";
    let licencia2 = "";
    let monto = "";
    switch (input) {
        case '6':
            licencia = "PREMIUN con licencia valida para 6 Meses";
            monto = 54.90;
            licencia2 = "PREMIUN";

            break;
        case 'anual':
            licencia = "VIP con licencia valida para 1 Año";
            monto = 100.90;
            licencia2 = "VIP";

            break;

        default:
            licencia = "BASICO  con licencia valida para 1 Mes";
            licencia2 = "BASICO";
            monto = 10;
            break;
    }
    let mitoken = $('#form-licencia input[name="csrf_token"]').val();
    let data = { 'licencia2': licencia, 'licencia': licencia2, _token: mitoken }
    swal({
        title: "Confirmación de Compra",
        icon: 'warning',
        text: 'Estas a punto de Comprar el Plan ' + licencia + " con un costo de " + monto + " USD",
        buttons: {
            confirmButton: {
                value: true,
                text: "Confirmar",
                className: 'btn btn-success'

            },
            cancelButton: {
                value: null,
                text: 'Cancelar',
                className: 'btn btn-danger'
            }
        }
    }).then((value) => {
        if (value == true) {
            showSuccessToast("Espera Un Momento seras Redirigido a la pagina de Pago");
            $.ajax({
                type: "get",
                url: "/Pagos/payment",
                dataType: "json",
                data: data,

                success: function (response) {
                    if (response.value == false) {
                        error("Hubo un error al crear la Solicitud de pago,Recargue la pagina e intentalo nuevamente");
                    } else {
                        console.log(response.value);
                        window.location.href = response;
                    }





                },
                error: function (e) {
                    console.log(e);

                    error("No se pudo crear la solicitud de pago en PayPal");
                }
            });
        }
    });

});
$(document).on('click', '#cuenta', function () {
    let dni = $("#dni-user").text().trim();
    window.location.href = "/Cuenta/MiCuenta";
});
$(document).on('click', '#logout', function () {
    window.location.href = "/Login/logout";
});
$(document).on('click', '#licencias', function () {
    $("#modalPlanes").modal();
});

$(document).on('click', '#resume', function (e) {
    e.preventDefault();
    let data = $("#dni-").val();
    let mitoken = $('#miForm2 input[name="csrf_token"]').val();
    $("#resume").attr('class', "btn btn-warning btn-icon-text");
    $("#inf").attr('class', "btn btn-primary btn-icon-text");
    $.ajax({
        type: "GET",
        contentType: "application/json; charset=utf-8",
        url: "/Transacciones/Resumen",
        data: { _token: mitoken },
        success: function (response) {
            $("#div-resume").html(response);
        }, error: function (xhr, status, error) {
            console.log(error);
            swal({
                title: "ERROR",
                icon: "error",
                text: "No tienes ninguna Transacción",
                value: true,
                confirmButtonText: "Ok",
            }).then((value) => {

            });
        }
    });


});
$(document).on('click', '#inf', function (e) {
    e.preventDefault();
    $("#inf").attr('class', "btn btn-warning btn-icon-text");
    $("#resume").attr('class', "btn btn-primary btn-icon-text");
    $("#div-resume").empty();

});

$(document).on('click', '#login', function (e) {
    e.preventDefault();
    let user = $("#exampleInputEmail").val();
    let password = $("#exampleInputPassword").val();
    let dat = { 'user': user, 'password': password, _token: $('meta[name="csrf-token"]').attr('content'), };
    if (user == "" || password == "") {
        error("Complete todos los Campos");
    } else {
        $.ajax({
            type: "get",
            url: "/Login/Loguearse",
            data: (dat),
            dataType: "json",
            success: function (response) {
                if (response.value == false) {
                    error("Usuario u Contraseña Incorrecta");
                } else {
                    confirmation2("Bienvenido");

                }
            }
        });
    }
});
function confirmation2(text, dni) {
    swal({
        title: "Felicitaciones",
        icon: "success",
        text: text,
        value: true,
        confirmButtonText: "Ok",
    }).then((value) => {
        window.location.href = "/Cuenta/MiCuenta";

    });
}
function confirmation3(text, dni) {
    swal({
        title: "Confirmación",
        icon: "success",
        text: text + " " + dni,
        value: true,
        confirmButtonText: "Ok",
    }).then((value) => {
        window.location.href = '/Login/IniciarSesion';


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
