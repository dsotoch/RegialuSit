$(document).ready(function () {

    let license = $("#lice").val();
    if (license == "") {
        license = "null";
    }
    let name = $("#dni-").val();
    $("#tipo-user").text(name);
    $.ajax({
        type: "get",
        url: "/Licencias/Verificar",
        data: { 'key': license, _token: $('#miform2 input[name="csrf_token"]').val() },
        dataType: "json",
        success: function (response) {
            if (response.valid == true) {
                $("#licencias").prop('hidden', true);
            } else {
                if (response.reason == 'Licencia vencida o inactiva.') {
                    $("#licencias").prop('hidden', false);
                    error("Licencia vencida o inactiva.");
                } else {
                    error(response.reason);
                    $("#licencias").prop('hidden', false);

                }

            }
        }
    });
});
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
