<?php
        session_start();    
        include "DbConfig.php";
        $email=$_SESSION['email'];
        //Creamos la conexion con la BD.
        $link = mysqli_connect($server, $user, $pass, $basededatos);
        if(!$link){
            die("Fallo al conectar con la base de datos: " .mysqli_connect_error());
        }
        // Operar con la BD
        $allQuestions = "SELECT * FROM preguntas";
        $myQuestions = "SELECT * FROM preguntas WHERE email='".$email."'";
        $resul = mysqli_query($link, $allQuestions);
        $resul2 = mysqli_query($link, $myQuestions);
        echo "Mis preguntas/Todas las preguntas: ".mysqli_num_rows($resul2)."/".mysqli_num_rows($resul);
        mysqli_close($link);
    ?>