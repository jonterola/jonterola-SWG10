<?PHP
session_start ();
if(isset($_SESSION['email']) ){
	echo "<script>alert ('No tienes permisos para acceder a esta funcionalidad!');</script>";
	echo "<script>window.location.href='Layout.php';</script>";
	exit(0);}
?>
<html>

<head>
  <?php include '../html/Head.html'?>
  <style>
		.table_flogin {
			margin: auto;
      text-align: center;
		}
		sup {
			color: red;
		}
    h2 {
        color: darkblue;
    }
    .error {
        color: darkred;
    }
    .success {
        color: darkgreen;
    }
    
  </style>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <?php include '../php/DbConfig.php' ?>
  <section class="main" id="s1">
    <div>
      <form id="flogin" name="flogin" method="POST" enctype="multipart/form-data" action="">
        <table class="table_flogin">
          <tr><th><h2>Recuperar Contraseña</h2><br/></th></tr>
          <tr><td>Dirección de correo<sup>*</sup> <input type="email" size="65" id="dirCorreo" name="dirCorreo"></td></tr>
          <tr><td><div id="buttons"><input type="submit" id="submit" value="Enviar"> <input type="reset" id="reset" value="Limpiar"></div></td></tr>
        </table>
      </form>
    </div>
    
    <div>
        <?php
            if(isset($_REQUEST['dirCorreo'])){
                if($_REQUEST['dirCorreo'] == ""){
                    echo "<p class=\"error\">Introduzca su correo electrónico!<p><br/>";
                }else{
                    $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
                    if(!$mysqli){
                        die("Fallo al conectar con Mysql: ".mysqli_connect_error());
                        echo "<span><a href='javascript:history.back()'>Volver</a></span>";
                    }
                    $sql = "SELECT * FROM usuarios WHERE email=\"".$_REQUEST['dirCorreo']."\";";
                    $resultado = mysqli_query($mysqli, $sql, MYSQLI_USE_RESULT);
                    if(!$resultado){
                      die("Error: ".mysqli_error($mysqli));
                      echo "<span><a href='javascript:history.back()'>Volver</a></span>";
                    }
                    $row = mysqli_fetch_array($resultado);
                    if(empty($row)){
                        echo "<p class=\"error\">No existe ninguna cuenta asociada a ese correo electrónico.<p><br/>";
                    }else{
                        $codigo= rand ( 10000 , 99999 );
                        $_SESSION['emailRec'] = $_REQUEST['dirCorreo'];
                        $_SESSION['codigo'] = $codigo;
                        $mensaje="<html>
                        <head>
                          <title>Recuperación de contraseña</title>
                        </head>
                        <body>
                          <h3>Pasos para recuperar tu contraseña</h3>
                          <ol>
                            <li>Entra en el link proporcionado</li>
                            <li>Introduce el código y la nueva contraseña</li>
                          </ol>
                          <h3>Link a la página de recuperación</h3>
                          <h2><a href='http://swjontelletxea.000webhostapp.com/jonterola-SWG10/php/ModifyPassword.php'>Aquí</a></h2>
                          <h3>Código de recuperación</h3>
                          <h2>".$codigo."</h2>
                        </body>
                        </html>";

                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                        mail($_REQUEST['dirCorreo'],'Recuperación de contraseña',$mensaje,$headers);
                        

                        echo "<p>Te hemos enviado un correo eléctronico con los pasos para restablecer la contraseña.</p>";
                    }
                }
                
                

            }
        ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>