function showOnLogIn(tipoUsu) {
    $('#registro').hide();
    $('#login').hide();
    $('#logout').show();
    $('#inicio').show();
    if (tipoUsu == 1 || tipoUsu == 2) {
        $('#insertar').show();
        $('#verBD').show();
        $('#verXML').show();
    } else if (tipoUsu == 3) {
        $('#gestionarUsuarios').show();
    }
    $('#creditos').show();
    //$("#h1").append("<img width=\"50\" height=\"50\" src=\"data:image/*;base64,<?php echo getImagenDeBD();?>\" alt=\"Img\"/>");
}

function showOnNotLogIn() {
    $('#registro').show();
    $('#login').show();
    $('#logout').hide();
    $('#inicio').show();
    $('#insertar').hide();
    $('#creditos').show();
    $('#verBD').hide();
    $('#verXML').hide();
    $('#gestionarUsuarios').hide();
}

$(document).ready(function () {

});