<?PHP
session_start ();
if(isset($_SESSION['email']) || !isset($_SESSION['codigo']) || !isset($_SESSION['emailRec'])){
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
          <tr><th><h2>Modificar Contraseña</h2><br/></th></tr>
          <tr><td>Nueva contraseña<sup>*</sup> <input type="password" size="65" id="pass1" name="pass1" pattern=".{6,}" title="Seis o más caracteres." required></td></tr>
          <tr><td>Repite la nueva contraseña<sup>*</sup> <input type="password" size="65" id="pass2" name="pass2" pattern=".{6,}" title="Seis o más caracteres." required></td></tr>
          <tr><td>Codigo de recuperación<sup>*</sup> <input type="text" size="65" id="codigo" name="codigo" required></td></tr>
          <tr><td><div id="buttons"><input type="submit" id="submit" value="Enviar"> <input type="reset" id="reset" value="Limpiar"></div></td></tr>
        </table>
      </form>
    </div>
    
    <div>
        <?php
        if(isset($_REQUEST['codigo'])){
            $pass1 = $_REQUEST['pass1'];
            $pass2 = $_REQUEST['pass2'];
            $codigo = $_REQUEST['codigo'];

            if(strcmp($pass1, $pass2) != 0){
                echo "<p class=\"error\">Las contraseñas no coinciden.<p><br/>";
            }else if($codigo != $_SESSION['codigo']){
                echo "<p class=\"error\">El código no es válido.<p><br/>";
            }else{
                $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
                if (!$mysqli) {
                    die("Fallo al conectar a MySQL: " . mysqli_connect_error());
                }
                $pass = crypt($pass1,'./0-9A-Za-z');
                $email = $_SESSION['emailRec'];
                $sql="UPDATE usuarios SET pass='$pass' WHERE email='$email';";
                if(!mysqli_query($mysqli, $sql)) {
                    die("Fallo al borrar en la BD: " . mysqli_error($mysqli));
                } 

                echo "<script>alert ('Contraseña modificada correctamente!');</script>";
                echo "<script>window.location.href='Layout.php';</script>";
            }
        }else{
        }
        ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>