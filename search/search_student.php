<?php
    include_once '../dbConnection.php';
    $query = "SELECT * FROM user ORDER BY groupnum, last_name";
    $salida = "";

    if(isset($_POST['consulta'])){
      $q = $con->real_escape_string($_POST['consulta']);
      $query = "SELECT * FROM user WHERE name LIKE '%".$q."%' OR last_name LIKE '%".$q."%' OR schoolnumber LIKE '%".$q."%' OR groupnum LIKE '%".$q."%' OR career LIKE '%".$q."%' ORDER BY last_name";
    }
    $resultado = $con->query($query);
    if($resultado->num_rows > 0){
      $salida.="
            <div class='table-responsive'>
              <table class='table table-striped title1'>
                <thead>
                  <tr style='color:#879E0F; font-size:19px;'>
                    <td><b>S.N.</b></td>
                    <td><b>Nombre</b></td>
                    <td><b>Apellidos</b></td>
                    <td><b>Género</b></td>
                    <td><b>Carrera</b></td>
                    <td><b>Matrícula</b></td>
                    <td><b>Grupo</b></td>
                  </tr>
                </thead>
                <tbody>";
      $c=1;
      while($row = $resultado->fetch_assoc()){
        $salida.="
                  <tr>
                    <td style='color:RED'>".$c++."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['last_name']."</td>
                    <td>".$row['gender']."</td>
                    <td>".$row['career']."</td>
                    <td>".$row['schoolnumber']."</td>
                    <td>".$row['groupnum']."</td>
                    <td>
                      <a title='Delete User' href='update_teacher.php?dschoolnumber=".$row['schoolnumber']."'>
                        <b>
                          <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                        </b>
                      </a>
                    </td>
                  </tr>";
      }
      $salida.="
                </tbody>
              </table>
            </div>";
    }
    else{
      $salida= "No hay registros";
    }
    echo $salida;
    
    $c=0;
?>