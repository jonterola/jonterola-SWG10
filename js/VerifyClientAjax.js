function verifyClient() {
    var email = $('#dirCorreo').val();
    $("#verify").html('');
    $.ajax({
        type: 'post',
        url: '../php/ClientVerifyEnrollment.php',
        data: { email: email },
        dataType: 'HTML',
        success: function (response) {
            if (response == 'SI') {
                $("#verify").attr("style", "color:green")
                $("#verify").html('El usuario es VIP');
                $("#submit").attr("disabled", false);
            } else {
                $("#verify").attr("style", "color:red")
                $("#verify").html('El usuario NO es VIP');
                $("#submit").attr("disabled", true);
            }

        }
    });
}

function verifyPass() {
    var pass = $('#pass1').val();
    $("#verifyPass").html('');
    $.ajax({
        type: 'post',
        url: '../php/ClientVerifyPass.php',
        data: { pass: pass },
        dataType: 'HTML',
        success: function (response) {
            if (response == 'VALIDA') {
                $("#verifyPass").attr("style", "color:green")
                $("#verifyPass").html('La contraseña es VÁLIDA');
                $("#submit").attr("disabled", false);
            } else if (response == 'INVALIDA') {
                $("#verifyPass").attr("style", "color:red")
                $("#verifyPass").html('La contraseña es INVÁLIDA');
                $("#submit").attr("disabled", true);
            } else {
                $("#verifyPass").attr("style", "color:red")
                $("#verifyPass").html('SIN SERVICIO');
                $("#submit").attr("disabled", true);
            }

        }
    });
}

