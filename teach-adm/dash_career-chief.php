<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TestLine | |
    Tecnológico de Estudios Superiores de Ixtapaluca
    </title>

    <link rel="shortcut icon" href="../image/logo.png" />
    <link  rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link  rel="stylesheet" href="../css/bootstrap-theme.min.css"/>    
    <link rel="stylesheet" href="../css/main.css">
    <link  rel="stylesheet" href="../css/font.css">
    <script src="../js/jquery.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js"  type="text/javascript"></script>
    <script src="js/search_teacher.js" type="text/javascript"></script>
    <script src="js/search_test.js" type="text/javascript"></script>
    <script src="js/cargar.js"></script>
 	  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

    <script>
      $(function () {
        $(document).on( 'scroll', function(){
          console.log('scroll top : ' + $(window).scrollTop());
          if($(window).scrollTop()>=$(".logo").height()){
            $(".navbar").addClass("navbar-fixed-top");
          }

          if($(window).scrollTop()<$(".logo").height()){
            $(".navbar").removeClass("navbar-fixed-top");
          }
        });
      });
    </script>

    <script>
      function validateForm() {
        var y = document.forms["form"]["name"].value;	
        var letters = /^[A-Za-z]+$/;
        if (y == null || y == "") {
          alert("¡¡¡Es Necesario Escribir El Nombre Del Profesor!!!");
          return false;
        }        
        var x = document.forms["form"]["schoolnumber"].value;
        if(x.length<9){
          alert("¡¡¡El Número De Empleado Debe Estar Conformada Por Al Menos 4 Caracteres!!!");
          return false;
        }
      }
    </script>
  </head>

  <body style="background-image: url(../image/background.png); ">
    <div class="header">
      <div class="row">
        <div class="col-lg-6">
          <span class="logo">TestLine TESI</span>
        </div>

        <?php
          include_once '../dbConnection.php';
          session_start();
          if(!(isset($_SESSION['email']))){
            header("location:index.php");
          }
          else{
            $name = $_SESSION['name'];
            $email=$_SESSION['email'];
            include_once '../dbConnection.php';
            echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hola '.$name.'</span> &nbsp;|&nbsp;<a href="logout_career-chief.php?q=dash_career-chief.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Cerrar Sesión</button></a></span>';
          }
        ?>
      </div>
    </div>

    <!-- career chief start-->

    <!--navigation menu-->
    <nav class="navbar navbar-default title1">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="dash.php?q=0">
            <b>TestLine TESI&nbsp;</b>
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="dash_career-chief.php?q=0"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Inicio<span class="sr-only">(current)</span></a></li>
            <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="dash_career-chief.php?q=1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Profesores</a></li>
		        <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="dash_career-chief.php?q=3"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>&nbsp;Observaciones</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav><!--navigation menu closed-->

    <div class="container"><!--container start-->
      <div class="row">
        <div class="col-md-12">
          <!--home start-->

          <?php 
            if(@$_GET['q']==0) {
              $result = mysqli_query($con,"SELECT * FROM quiz ORDER BY groupnum ") or die('Error');
              echo  '
              <div class="row">
                <label style="color:#080C3E; font-size:32px;">CONSULTAR EVALUACIONES</label>
                <div class="form-1-2">
                  <label style="color:#080C3E; font-size:20px;">Buscar por asignatura o grupo</label>
                  <input type="text" name="search_box1" id="search_box1"/>
                </div>
                <div class="panel" id="data1" name="data1">
                </div>
              </div>';
            }
          ?>

          <?php
            //result display
            if(@$_GET['q']==4) {
              $eid=@$_GET['eid'];
              $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid = '$eid'") or die('Error');
              while($row = mysqli_fetch_array($q)) {
                $title = $row['title'];
                $gr = $row['groupnum'];
              }

              echo'
              <label style="color:#080C3E; font-size:31px;"> Resultados de la evaluación: '.$title.'</label><br />
              <label style="color:#080C3E; font-size:31px;"> Grupo: '.$gr.'</label>
              <div class="panel">
              
                <div class="table-responsive">
                  <table class="table table-striped title1">
                    <tr style="color:#879E0F; font-size:18px;">
                      <td><b>Matrícula</b></td>
                      <td><b>Nombre del alumno</b></td>
                      <td><b>Puntaje Máximo</b></td>
                      <td><b>Puntaje Obtenido</b></td>
                      <td><b>Respuestas Correctas<b></td>
                      <td><b>Respuestas Incorrectas</b></td>
                      <td><b>Porcentaje Obtenido<b></td>
                    </tr>';

              $q2=mysqli_query($con,"SELECT * FROM user WHERE groupnum = '$gr' ORDER BY last_name ASC") or die('Error');
              while($row = mysqli_fetch_array($q2)) {
                $nam=$row['name'];
                $scn=$row['schoolnumber'];
                $lname=$row['last_name'];
                $student=$lname." ".$nam;
                
                $q3=mysqli_query($con,"SELECT * FROM qualification WHERE eid = '$eid' AND schoolnumber = $scn") or die('Error');
                while($row = mysqli_fetch_array($q3)) {
                  $ts=$row['total_score'];
                  $fs=$row['final_score'];
                  $rans=$row['right_ans'];
                  $wans=$row['wrong_ans'];
                  $pc=$row['porcent'];
                
                  echo'
                    <tr>
                      <td>'.$scn.'</td>
                      <td>'.$student.'</td>
                      <td>'.$ts.'</td>
                      <td>'.$fs.'</td>
                      <td>'.$rans.'</td>
                      <td>'.$wans.'</td>
                      <td>'.$pc.'&nbsp;%</td>
                    </tr>
                  ';
                }
              }
                
              echo'
                  </table>
                  <b>
                    <a href="dash_career-chief.php?q=0" class="pull-right btn sub1" style="margin:0px;background:#9B9999;width:130px;">
                      <span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;
                      <span class="title1">
                        <b>REGRESAR</b>
                      </span>
                    </a>
                  </b>&nbsp;
                  <b>
                    <a href="generate_pdf/generateadm_pdf.php?eid='.$eid.'" target="_blank" class="pull-right btn sub1" style="margin:0px;background:#64D852;width:150px;">
                      <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>&nbsp;
                      <span class="title1">
                        <b>DESCARGAR</b>
                      </span>
                    </a>
                  </b>
                </div>
              </div>
              ';
            }
          ?>
          <!--home closed-->

          <!--teacher start-->
          <?php 
            if(@$_GET['q']==1) {

              echo '
                  <div class="row">
                    <div class="col-md-4 panel">
                      <h4 style="color:#879E0F; font-size:30px; margin-top:-13px;">REGISTRO DE PROFESORES</h4><br>
                      <form name="frmSubirCSV" id="frmSubirCSV" method="post" enctype="multipart/form-data">
                        <h3>Subir archivo CSV</h3>
                        <p><input type="file" name="archivo_csv" id="archivo_csv"></p>
                        <p><input type="submit" class="enviar_archivo separar_boton" value="Enviar archivo"></p>
                        <div id="estado"></div>
                      </form><br>
                      <form class="form-horizontal" name="form" action="sign_teacher.php" onSubmit="return validateForm()" method="POST">
                        <fieldset>
                          <h3>Registro individual</h3>
                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="name"></label>  
                            <div class="col-md-12">
                              <label style="font-size: 10px; color:red;">* Campos obligatorios</label>
                              <label>Nombre completo del docente: </label> <label style="color:red;">*</label>
                              <input id="name" name="name" placeholder="&#128100;   Ej. Juan Ignacio Perez Lopez" class="form-control input-md" type="text">
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label title1" for="employnumber"></label>
                            <div class="col-md-12">
                              <label>Número de empleado: </label> <label style="color:red;">*</label>
                              <input id="employnumber" name="employnumber" placeholder="&#10122;   Ej. 123456789" class="form-control input-md" type="number" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            </div>
                          </div>';   

              if(@$_GET['q7']) {
                     echo'<p style="color:red;font-size:15px;">'.@$_GET['q7'];
              }

              echo '
                          <!-- Button -->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for=""></label>
                            <div class="col-md-12"> 
                              <input  type="submit" class="sub" value="REGISTRAR PROFESOR" class="btn btn-primary"/>
                            </div>
                          </div>
                        </fieldset>
                      </form>
                    </div>
                    <div class="col-md-6">
                      <label style="color:#080C3E; font-size:32px;">PROFESORES REGISTRADOS</label>
                      <div class="form-1-2">
                        <label style="color:#080C3E; font-size:20px;">Buscar</label>
                        <input type="text" name="search_box" id="search_box"/>
                      </div>
                      <div id="data" name="data">
                      </div>
                    </div>
                  </div>';             
            }
          ?>
          <!--teacher end-->

          <!--feedback start-->
          <?php 
            if(@$_GET['q']==3) {
              $result = mysqli_query($con,"SELECT * FROM `feedback` ORDER BY `feedback`.`date` DESC") or die('Error');
              echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1"><label style="color:#080C3E; font-size:32px;">BUZÓN DE OBSERVACIONES</label><tr style="color:#879E0F; font-size:19px;"><td><b>S.N.</b></td><td><b>Asunto</b></td><td><b>Matrícula</b></td><td><b>Fecha</b></td><td><b>Hora</b></td><td><b>Remitente</b></td><td></td><td></td></tr>';
              $c=1;

              while($row = mysqli_fetch_array($result)) {
                $date = $row['date'];
                $date= date("d-m-Y",strtotime($date));
                $time = $row['time'];
                $subject = $row['subject'];
                $name = $row['name'];
                $schoolnumber = $row['schoolnumber'];
                $id = $row['id'];
	              echo '<tr><td>'.$c++.'</td>';
	              echo '<td><a title="Clic para ver la observación" href="dash_career-chief.php?q=3&fid='.$id.'">'.$subject.'</a></td><td>'.$schoolnumber.'</td><td>'.$date.'</td><td>'.$time.'</td><td>'.$name.'</td>
	              <td><a title="Abrir observación" href="dash_career-chief.php?q=3&fid='.$id.'"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>';
	              echo '<td><a title="Eliminar observación" href="update_admin.php?fdid='.$id.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
              }

              echo '</table></div></div>';
            }
          ?>
          <!--feedback closed-->

          <!--feedback reading portion start-->
          <?php 
            if(@$_GET['fid']) {
              echo '<br />';
              $id=@$_GET['fid'];
              $result = mysqli_query($con,"SELECT * FROM feedback WHERE id='$id' ") or die('Error');

              while($row = mysqli_fetch_array($result)) {
                $name = $row['name'];
                $subject = $row['subject'];
                $date = $row['date'];
                $date= date("d-m-Y",strtotime($date));
                $time = $row['time'];
                $feedback = $row['feedback'];
                echo '<div class="panel"<a title="Back to Archive" href="update_admin.php?q1=2"><b><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span></b></a><h2 style="text-align:center; margin-top:-15px;font-family: "Ubuntu", sans-serif;"><b>'.$subject.'</b></h1>';
                echo '<div class="mCustomScrollbar" data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:450px; line-height:35px;padding:5px;"><span style="line-height:35px;padding:5px;">-&nbsp;<b>Fecha:</b>&nbsp;'.$date.'</span>
                <span style="line-height:35px;padding:5px;">&nbsp;<b>Hora:</b>&nbsp;'.$time.'</span><span style="line-height:35px;padding:5px;">&nbsp;<b>Enviado por:</b>&nbsp;'.$name.'</span><br />'.$feedback.'</div></div>';
              }
            }
          ?>
          <!--Feedback reading portion closed-->

        </div><!--container closed-->
      </div>
    </div>
  </body>
</html>
