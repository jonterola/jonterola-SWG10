<?PHP
session_start ();
if(!isset($_SESSION['email']) || $_SESSION['tipo'] == 3){
  echo "<script>alert ('No tienes permisos para acceder a esta funcionalidad!');</script>";
  echo "<script>window.location.href='Layout.php';</script>";
  exit(0);}
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <style>
		.table_Questions {
			margin: auto;
      border-collapse: collapse;
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
  <section class="main" id="s1">
    <div id = "div1">
      <!--Código PHP para mostrar una tabla con las preguntas de la BD.<br>
      La tabla no incluye las imágenes-->
      <?php
        echo("<table>");
        echo("<tr><th>Autor</th><th>Enunciado</th><th>Respuesta correcta</th></tr>");
        $xml = simplexml_load_file('../xml/Questions.xml');
        foreach($xml->children() as $pregunta){
            echo "<tr>";
            $author = (string)$pregunta['author'];
            echo utf8_decode("<td>$author</td>");
            foreach($pregunta->children() as $child){
                if($child->getName() == 'itemBody'){
                    echo utf8_decode("<td>$child->p</td>");
                }
                if($child->getName() == 'correctResponse'){
                    echo utf8_decode("<td>$child->response</td>");
                }
                               
            }
            echo ("</tr>");
        }
      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
