function confirmChange(email, estado) {
    if (confirm('¿Está seguro de que quiere cambiar el estado de este usuario?')) {
        $.ajax({
            url: "../php/ChangeUserState.php",
            type: "POST",
            data: { email: email, estado: estado },
            dataType: "html",
            success: function (response) {
                $("#tablaUsuarios").html(response);
            }
        });

    }
}

function confirmDelete(email) {
    if (confirm('¿Está seguro de que quiere eliminar este usuario de la BD?')) {
        $.ajax({
            url: "../php/RemoveUser.php",
            type: "POST",
            data: { email: email },
            dataType: "html",
            success: function (response) {
                alert('El usuario se ha eliminado correctamente!');
                $("#tablaUsuarios").html(response);
            }
        });

    }
}