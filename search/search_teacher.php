<?php
    include_once '../dbConnection.php';
    $query = "SELECT * FROM teacher ORDER BY employnumber";
    $salida = "";

    if(isset($_POST['consulta'])){
      $q = $con->real_escape_string($_POST['consulta']);
      $query = "SELECT * FROM teacher WHERE name LIKE '%".$q."%' OR employnumber LIKE '%".$q."%' ORDER BY employnumber";
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
                    <td><b>Núm. de empleado</b></td>
                  </tr>
                </thead>
                <tbody>";
      $c=1;
      while($row = $resultado->fetch_assoc()){
        $salida.="
                  <tr>
                    <td style='color:RED'>".$c++."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['employnumber']."</td>
                    <td>
                      <a title='Delete User' href='update_admin.php?demploynumber=".$row['employnumber']."'>
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