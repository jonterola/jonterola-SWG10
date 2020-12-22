function insertarPregunta() {
    var question = $("#fquestion").get(0);
    $.ajax({
        type: 'post',
        dataType: 'HTML',
        url: 'AddQuestionWithImage.php',
        data: new FormData(question),
        mimeType: 'multipart/form-data',
        contentType: false,
        processData: false,
        dataType: 'HTML',
        success: function (response) {
            //$('form')[0].reset();
            // $("#feedback").text(response);
            if (response == "huquei") {
                $('#fquestion').trigger("reset");
                $("#addQuestionMessage").text("Pregunta almacenada con éxito.");
                pedirPreguntas();
            }
            else
                alert(response)
                $("#addQuestionMessage").text("Algo no ha ido como esperaba, revise los campos.");
        }
    });
}