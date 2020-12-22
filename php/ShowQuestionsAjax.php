<?PHP
session_start ();
?>
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