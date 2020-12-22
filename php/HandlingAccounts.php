<?PHP
session_start ();
if(!isset($_SESSION['email']) || $_SESSION['tipo'] != 3){
  echo "<script>alert ('No tienes permisos para acceder a esta funcionalidad!');</script>";
  echo "<script>window.location.href='Layout.php';</script>";
  exit(0);}
?>
<!DOCTYPE html>
<html>
<head>
  <script src="../js/UserManagement.js"></script>
  <?php include '../html/Head.html'?>
  <style>
		.table_Questions {
			margin: auto;
      border-collapse: collapse;
      text-align: center;
    }
    td, th {
      padding: 5px;
    }
    th {
      background-color: #dbd2c3;
    }
    #div1 {
         overflow: scroll;
         height: 100%;
         width: 100%;
    }
    #div1 table {
        width: 95%;
        background-color: lightgray;
    }
  </style>
</head>
<body>
  <?php include '../php/Menus.php'?>
  <?php include '../php/DbConfig.php'?>
  <?php include '../php/LoadUserTable.php'?>
  <section class="main" id="s1">
    <div id = "div1">
      <!--Código PHP para mostrar una tabla con las preguntas de la BD.<br/> La tabla incluye las imágenes de la BD.-->
      <?php
        //Creamos la conexion con la BD.
        $link = mysqli_connect($server, $user, $pass, $basededatos);
        if(!$link){
            die("Fallo al conectar con la base de datos: " .mysqli_connect_error());
        }
        // Operar con la BD
        $sql = "SELECT * FROM usuarios;";
        $resul = mysqli_query($link, $sql);
        echo '<div id ="tablaUsuarios">';
        loadTable($resul);
        echo '</div>';
        mysqli_close($link);
    ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
