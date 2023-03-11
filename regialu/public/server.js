$(document).ready(function () {
    var urlParams = new URLSearchParams(window.location.search);
    var paymentId = urlParams.get('paymentId');
    var token = urlParams.get('token');
    var payerId = urlParams.get('PayerID');
    $("#Payment-id").html("Id. de pago" + ": " + token);
    $("#token-id").html("Token de seguridad" + ": " + token);
    $("#payer-id").html("identificación del pagador" + ": " + payerId);
    var csrf_token = $('#serv input[name="csrf_token"]').val();
    if (token != null) {
        $.ajax({
            type: "get",
            url: "/Pagos/Detalles",
            data: ({ 'payment_id': paymentId, 'payer_id': payerId, 'token': token, _token: csrf_token }),
            dataType: "json",
            success: function (response) {
                console.log(response);
                var tabla = $("#detalles");
                if (response.value.purchase_units[0].payments.captures[0].status == 'COMPLETED') {
                    var valor = response.value.purchase_units[0].payments.captures[0].amount.value;
                    var create_time = response.value.purchase_units[0].payments.captures[0].create_time;
                    let date = new Date(create_time);
                    let local_date = date.toLocaleDateString();
                    var id = response.value.purchase_units[0].payments.captures[0].id;
                    $("#titulo").text("TRANSACCION APROBADA");
                    $("#div-respuesta").css('background-color', 'green');
                    $("#detalles").append('<tr> <td> Valor de la Compra : USD' + valor + '  </td></tr>');
                    $("#detalles").append('<tr> <td> Fecha  de la Compra : ' + local_date + '  </td></tr>');
                    $("#detalles").append('<tr> <td id="id-compra"> Identificador de la Compra : ' + id + '</td></tr>');
                    let dat = {
                        'monto': valor, 'payment_id': id,
                        'payer_id': payerId, _token: $('#serv input[name="csrf_token"]').val()
                    };
                    $.ajax({
                        type: "get",
                        url: "/Licencias/Activar",
                        data: dat,
                        dataType: "json",
                        success: function (response) {
                            if (response.value == true) {
                                confirmation("Muchas Gracias por su Compra ! LICENCIA ACTIVADA CORRECTAMENTE !.. Inicie Sesion Nuevamente  y el Software estara Activado");
                            } else {
                                error(response.ex + "Hubo un Error Al Activar la licencia ...Comuniquese con Soporte, Anote su identificador de Pago y su Identificacion de pagador");
                            }
                        }
                    });
                } else {
                    $("#titulo").text("TRANSACCION DENEGADA");
                    $("#div-respuesta").css('background-color', 'red');
                }

            }





        });
    } else {
        error("Actualize la Pagina e Intentelo Nuevamente");
    }

});
function confirmation(text, dni) {
    swal({
        title: "Felicitaciones",
        icon: "success",
        text: text,
        value: true,
        confirmButtonText: "Ok",
    }).then((value) => {
        window.location.href = '/Login/logout';


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
