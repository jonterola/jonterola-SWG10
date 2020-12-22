function pedirPreguntas() {
    XMLHttpRequestObject = new XMLHttpRequest();
    XMLHttpRequestObject.onreadystatechange = function () {
        if (XMLHttpRequestObject.readyState == 4) {
            alert(XMLHttpRequestObject.responseText);
            var obj = document.getElementById('questionTable');
            var respuesta = XMLHttpRequestObject.responseXML;
            obj.innerHTML = XMLHttpRequestObject.responseText;
        }
    }
    XMLHttpRequestObject.open("POST", "../php/ShowQuestionsAjax.php", true);
    XMLHttpRequestObject.send();
} 