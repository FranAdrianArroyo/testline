<?php
    include_once '../../dbConnection.php';
    $query = "SELECT * FROM quiz ORDER BY groupnum, subject";
    $salida = "";

    if(isset($_POST['consulta'])){
      $q = $con->real_escape_string($_POST['consulta']);
      $query = "SELECT * FROM quiz WHERE groupnum LIKE '%".$q."%' OR subject LIKE '%".$q."%' ORDER BY employnumber, subject";
    }
    $resultado = $con->query($query);
    if($resultado->num_rows > 0){
      $salida.="
            <div class='table-responsive'>
              <table class='table table-striped title1'>
                <thead>
                  <tr style='color:#879E0F; font-size:19px;'>
                    <td><b>S.N.</b></td>
                    <td><b>Asignatura</b></td>
                    <td><b>Profesor</b></td>
                    <td><b>Título de la evaluación</b></td>
                    <td><b>Grupo</b></td>
                    <td><b>Total de Preguntas</b></td>
                    <td><b>Descripción</b></td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>";
      $c=1;
      while($row = $resultado->fetch_assoc()){
        $emp = $row['employnumber'];
        $query1 = "SELECT * FROM teacher WHERE employnumber='".$emp."'";
        $resultado1 = $con->query($query1);
        if($resultado1->num_rows > 0){
          while($row1 = $resultado1->fetch_assoc()){
            $teacher = $row1['name'];
          }
        }
        
        $salida.="
                  <tr>
                    <td style='color:RED'>".$c++."</td>
                    <td>".$row['subject']."</td>
                    <td>".$teacher."</td>
                    <td>".$row['title']."</td>
                    <td>".$row['groupnum']."</td>                    
                    <td>".$row['total']."</td> 
                    <td>".$row['description']."</td>  
                    <td>
                      <b>
                        <a href='dash.php?q=4&eid=".$row['eid']."' class='pull-right btn sub1' style='margin:0px;background:#48A8D1'>
                          <span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>&nbsp;
                          <span class='title1'>
                            <b>VER RESULTADOS</b>
                          </span>
                        </a>
                      </b>
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