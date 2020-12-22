<?php

//index.php

//Include Configuration File
include('LogInGoogle.php');

$login_button = '';

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
  //It will Attempt to exchange a code for an valid authentication token.
  $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

  //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
  if(!isset($token['error']))
  {
      //Set the access token used for requests
      $google_client->setAccessToken($token['access_token']);

      //Store "access_token" value in $_SESSION variable for future use.
      $_SESSION['access_token'] = $token['access_token'];

      //Create Object of Google Service OAuth 2 class
      $google_service = new Google_Service_Oauth2($google_client);

      //Get user profile data from google
      $data = $google_service->userinfo->get();

      //Below you can find Get profile data and store into $_SESSION variable

      if(!empty($data['email']))
      {
        $_SESSION['email'] = $data['email'];
        $_SESSION['tipo'] = 1;
        $_SESSION['social'] = true;
        $_SESSION['image'] = "../images/anonimo.jpg";
      }

      if(!empty($data['picture']))
      {
        $_SESSION['image'] = $data['picture'];
      }
      
    }
}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
  $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="../images/sign-in-with-google.png" style="width: 100%; height: 100%; object-fit: contain;"/></a>';
}

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
      <form id="flogin" name="flogin" method="POST" enctype="multipart/form-data" action="LogIn.php">
        <table class="table_flogin">
          <tr><th><h2>Iniciar sesion</h2><br/></th></tr>
          <tr><td>Dirección de correo<sup>*</sup> <input type="email" size="65" id="dirCorreo" name="dirCorreo"></td></tr>
          <tr><td>Contraseña<sup>*</sup> <input type="password" size="75" id="pass1" name="pass1"></td></tr>
          <tr><td><div id="buttons"><input type="submit" id="submit" value="Enviar"> <input type="reset" id="reset" value="Limpiar"></div></td></tr>
        </table>
      </form>
    </div>
    
    <?php
    if($login_button == '')
    {
      echo "<script>window.location.href='Layout.php';</script>";
    }
    else
    {
      echo '<div align="center" style="width: 400px;height: 300px;text-align: center;margin-left: auto;margin-right: auto;">'.$login_button . '</div>';
    }
    ?>
    
       
    <div>
      <?php
        
        if(isset($_REQUEST['dirCorreo'])) {
          $email = $_REQUEST['dirCorreo'];
          $pass1 = $_REQUEST['pass1'];
          $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
          if(!$mysqli){
              die("Fallo al conectar con Mysql: ".mysqli_connect_error());
              echo "<span><a href='javascript:history.back()'>Volver</a></span>";
          }
          $sql = "SELECT * FROM usuarios WHERE email=\"".$email."\";";
          $resultado = mysqli_query($mysqli, $sql, MYSQLI_USE_RESULT);
          if(!$resultado){
            die("Error: ".mysqli_error($mysqli));
            echo "<span><a href='javascript:history.back()'>Volver</a></span>";
          }
          $row = mysqli_fetch_array($resultado);
          
          if(!empty($row) && $row['email']==$email && hash_equals($row['pass'], crypt($pass1, $row['pass']))){
            if($row['estado'] != 0){
              die('¡Cuenta bloqueada!');
              echo "<script> alert(\"¡Esta cuenta está bloqueada!\"); document.location.href='Layout.php'; </script>";
            }
            $tipo = $row['tipousu'];
            $image = $row['imagen'];
            if($email == 'admin@ehu.es'){ 
              $tipo = 3;
            }
            $_SESSION['email'] = $email;
            $_SESSION['tipo'] = $tipo;
            $_SESSION['image'] = $image;

            echo "<script> alert(\"¡Bienvenido!\"); document.location.href='Layout.php?logInMail=$email'; </script>";
					} else {
            echo "<p class=\"error\">Usuario o contraseña incorrectos!<p><br/>";
            // echo "<span><a href=\"javascript:history.back()\">Volver</a></span>";
          }
        }
      ?>
    </div>
    <div>
      <a href="ForgetPassword.php"><h3>¿Has olvidado tu contraseña?</h3></a>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>