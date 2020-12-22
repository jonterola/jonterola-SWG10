window.setInterval(function () {
    countQuestions();
}, 10000);

function countQuestions() {
    var email;
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('logInMail'))
        email = searchParams.get('logInMail');
    $.ajax({
        type: 'post',
        dataType: 'HTML',
        url: '../php/CountQuestions.php',
        data: { email: email },
        dataType: 'HTML',
        success: function (response) {
            $("#resultado").html(response);
        }
    });
}

