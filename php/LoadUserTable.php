<?php function loadTable($resul){
      echo '<table border="1px" class="table_Questions"><tr><th>Email</th><th>Password</th><th>Foto de perfil</th><th>Estado</th><th>Bloqueo</th><th>Borrar</th></tr>';
      while($row = mysqli_fetch_array($resul)){
          if($row['estado'] == 0){ $estado = 'activado';
          }
          else if($row['estado'] == 1){ $estado = 'bloqueado';
          }
          if($row['email'] != 'admin@ehu.es'){
          echo "<tr><td><a href=\"mailto:".$row['email']."\">".$row['email']."</a></td><td>".$row['pass']."</td><td><img width=\"150\" height=\"150\" src=\"data:image/*;base64, ".$row['imagen']."\" alt=\"Sin imagen relacionada\"/></td><td>".$estado."</td>
          <td><button onClick='return confirmChange(\"".$row['email']."\",".$row['estado'].")'>Cambiar Estado</button></td><td><button onClick='return confirmDelete(\"".$row['email']."\")'>Borrar</button></td></tr>";
          }
      }
      echo "</table>";
  }
  ?>