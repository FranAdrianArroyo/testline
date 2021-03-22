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
    <script src="../js/main.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js"  type="text/javascript"></script>
    <script src="js/search_student.js" type="text/javascript"></script>
    <script src="js/cargar_alumno.js" type="text/javascript"></script>
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
          alert("Es Necesario Escribir El Nombre");
          return false;
        }        
        var x = document.forms["form"]["schoolnumber"].value;
        if(x.length<9){
          alert("La matricula debe tener una extensión de 9 caracteres");
          return false;
        }
      }
    </script>

    <script>      

      window.onload = function() {
        
        var divCl = document.getElementsByName("closed");
        var divTF = document.getElementsByName("truefalse"); 
        
        for(let rec = 0; rec < divTF.length; rec++){
          var divsec = divTF[rec];
          divsec.style.display="none";
        }
      }      

      function hideDivs(cont){
        var cQ = "closed"+cont;
        var tfQ = "truefalse"+cont;
        if(document.getElementById('Pregunta cerrada'+cont).checked == true){
          document.getElementById(cQ).style.display="block";   
          document.getElementById(tfQ).style.display="none"; 
        }
        else{
          document.getElementById(cQ).style.display="none";   
          document.getElementById(tfQ).style.display="block"; 
        }               
      }
    </script>

  </head>

  <body style="background-image: url(../image/background.png); ">
    <div class="header">
      <div class="row">
        <div class="col-lg-6">
          <span class="logo">TestLine Adm.</span>
        </div>

        <?php
          include_once '../dbConnection.php';
          session_start();
          if(!(isset($_SESSION['employnumber']))){
            header("location:index.php");
          }
          else{
            $name = $_SESSION['name'];
            $employnumber=$_SESSION['employnumber'];
            include_once '../dbConnection.php';
            echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hola '.$name.'</span> &nbsp;|&nbsp;<a href="logout_teacher.php?q=dash_teacher.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Cerrar Sesión</button></a></span>';
          }
        ?>
      </div>
    </div>

    <!-- teacher start-->

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
          <a class="navbar-brand" href="dash_teacher.php?q=0">
            <b>TestLine TESI</b>
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="dash_teacher.php?q=0"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Inicio<span class="sr-only">(current)</span></a></li>
            <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="dash_teacher.php?q=1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Alumnos</a></li>
		        <li <?php if(@$_GET['q']==2 || @$_GET['q']==8) echo'class="active"'; ?>><a href="dash_teacher.php?q=2"><span class="glyphicon glyphicon-saved" aria-hidden="true"></span>&nbsp;Calificaciones</a></li>
		        <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="dash_teacher.php?q=3"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>&nbsp;Observaciones</a></li>
            <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5) echo'active"'; ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbsp;Exámenes<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="dash_teacher.php?q=4">Agregar Exámen</a></li>
                <li><a href="dash_teacher.php?q=5">Eliminar Exámen</a></li>
              </ul>
            </li>
            <li class="dropdown <?php if(@$_GET['q']==6 || @$_GET['q']==7) echo'active"'; ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;Datos personales<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="dash_teacher.php?q=6">Información personal</a></li>
                <li><a href="dash_teacher.php?q=7">Cambiar contraseña</a></li>
              </ul>
            </li>
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
              $result = mysqli_query($con,"SELECT * FROM quiz WHERE employnumber = $employnumber ORDER BY subject DESC") or die('Error');
              echo  '
              <div class="panel">
                <div class="table-responsive">
                  <table class="table table-striped title1">
                    <label style="color:#080C3E; font-size:31px;"> MIS EVALUACIONES CREADAS</label>
                    <tr style="color:#879E0F; font-size:18px;">
                      <td><b>S.N.</b></td>
                      <td><b>Asignatura</b></td>
                      <td><b>Título de la evaluación</b></td>
                      <td><b>Grupo</b></td>
                      <td><b>Total de Preguntas</b></td>
                      <td><b>Descripción</b></td>
                      <td><b>Fecha de creación</b></td>
                      <td></td>
                    </tr>';
              $c=1;

              while($row = mysqli_fetch_array($result)) {
                $subject = $row['subject'];
                $title = $row['title'];
                $group = $row['groupnum'];
                $total = $row['total'];
                $descrip = $row['description'];
                $dt = $row['date'];
                $eid = $row['eid'];	

                echo '
                    <tr>
                      <td>'.$c++.'</td>
                      <td>'.$subject.'</td>
                      <td>'.$title.'</td>
                      <td>'.$group.'</td>
                      <td>'.$total.'</td>
                      <td>'.$descrip.'</td>
                      <td>'.$dt.'&nbsp;min</td>
                      <td>
                        <b>
                          <a href="update_teacher.php?q=rmquiz&eid='.$eid.'" class="pull-right btn sub1" style="margin:0px;background:lightskyblue">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;
                            <span class="title1">
                              <b>Eliminar Evaluación</b>
                            </span>
                          </a>
                        </b>
                      </td>
                    </tr>';
              }
              $c=0;
              echo '
                  </table>
                </div>
              </div>';
            }

            //ranking start
            if(@$_GET['q']== 2) {
              $result = mysqli_query($con,"SELECT * FROM quiz WHERE employnumber = $employnumber ORDER BY subject DESC") or die('Error');
              echo  '
              <div class="panel">
                <div class="table-responsive">
                  <table class="table table-striped title1">
                    <label style="color:#080C3E; font-size:31px;"> RESULTADOS DE MIS EVALUACIONES</label>
                    <tr style="color:#879E0F; font-size:18px;">
                      <td><b>S.N.</b></td>
                      <td><b>Asignatura</b></td>
                      <td><b>Título de la evaluación</b></td>
                      <td><b>Grupo</b></td>
                      <td><b>Total de Preguntas</b></td>
                      <td><b>Descripción</b></td>
                      <td><b>Fecha de creación</b></td>
                      <td></td>
                    </tr>';
              $c=1;

              while($row = mysqli_fetch_array($result)) {
                $subject = $row['subject'];
                $title = $row['title'];
                $group = $row['groupnum'];
                $total = $row['total'];
                $descrip = $row['description'];
                $dt = $row['date'];
                $eid = $row['eid'];	

                echo '
                    <tr>
                      <td>'.$c++.'</td>
                      <td>'.$subject.'</td>
                      <td>'.$title.'</td>
                      <td>'.$group.'</td>
                      <td>'.$total.'</td>
                      <td>'.$descrip.'</td>
                      <td>'.$dt.'&nbsp;min</td>
                      <td>
                        <b>
                          <a href="dash_teacher.php?q=8&eid='.$eid.'" class="pull-right btn sub1" style="margin:0px;background:lightskyblue">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;
                            <span class="title1">
                              <b>VER RESULTADOS</b>
                            </span>
                          </a>
                        </b>
                      </td>
                    </tr>';
              }
              $c=0;
              echo '
                  </table>
                </div>
              </div>';
            }
          ?>
          <!--home closed-->

          <?php
            //result display
            if(@$_GET['q']==8) {
              $eid=@$_GET['eid'];
              $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid = '$eid'") or die('Error');
              while($row = mysqli_fetch_array($q)) {
                $title = $row['title'];
                $gr = $row['groupnum'];
              }

              echo'
              <br><label style="color:#080C3E; font-size:30px; margin-left:47px;"> RESULTADOS DE: </label> <label style="color:blue; font-size:27px"> '.$title.'</label><br />
              <label style="color:#080C3E; font-size:27px; margin-left:47px;"> GRUPO:</label> <label style="color:blue; font-size:25px"> '.$gr.'</label>
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
                  <br><br><br><b>
                    <a href="dash_teacher.php?q=2" class="pull-right btn sub1" style="margin:0px;background:#9B9999;width:130px;">
                      <span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;
                      <span class="title1">
                        <b>REGRESAR</b>
                      </span>
                    </a>
                  </b>&nbsp;
                  <b>
                    <a href="generate_pdf/generatetea_pdf.php?eid='.$eid.'" target="_blank" class="pull-right btn sub1" style="margin:0px;background:#64D852;width:150px;">
                      <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>&nbsp;
                      <span class="title1">
                        <b>DESCARGAR</b>
                      </span>
                    </a>
                  </b>  
                  <b>
                    <a href="generate_pdf/generatecer_pdf.php?eid='.$eid.'" target="_blank" class="pull-left btn sub1" style="margin:0px;background:#90EE90;width:250px;">
                      <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>&nbsp;
                      <span class="title1">
                        <b>GENERAR CERTIFICADOS</b>
                      </span>
                    </a>
                  </b>
                </div>
              </div>
              ';
            }
          ?>

          <!--users start-->
          <?php 
            if(@$_GET['q']==1) {

              echo '
                  <div class="row" style="background: whitesmoke;">
                    <div class="col-md-4 panel">
                      <h4 style="color:#879E0F; font-size:30px; margin-top:-13px;">REGISTRO DE ALUMNOS</h4><br>

                      <form name="frmSubirAlumnoCSV" id="frmSubirAlumnoCSV" method="post" enctype="multipart/form-data">
                        <h3>Subir archivo CSV</h3>
                        <p><input type="file" name="archivoalumno_csv" id="archivoalumno_csv" style="width: 340px;"></p>
                        <p><input type="submit" class="enviar_archivoalumno separar_boton" value="Enviar archivo"></p>
                        <div id="estado"></div>
                      </form><br>

                      <form class="form-horizontal" name="form" action="sign_student.php" onSubmit="return validateForm()" method="POST">
                        
                        <fieldset>
                          <h3>Registro individual</h3>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label title1" for="schoolnumber"></label>
                            <div class="col-md-12">
                              <label style="font-size: 10px; color:red;">* Campos obligatorios</label><br>
                              <label>Matricula de el/la alumno(a): </label> <label style="color:red;">*</label>
                              <input id="schoolnumber" name="schoolnumber" placeholder="&#10122;   Ej. 201632567"class="form-control input-md" type="number" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="name"></label>  
                            <div class="col-md-12">
                              <label>Nombre(s) de el/la alumno(a): </label><label style="color:red;">*</label>
                              <input id="name" name="name" placeholder="&#128100;   Ej. José Luis" class="form-control input-md" type="text" required>
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="last_name"></label>  
                            <div class="col-md-12">
                              <label>Apellidos de el/la alumno(a): </label> <label style="color:red;">*</label>
                              <input id="last_name" name="last_name" placeholder="&#128100;   Perez Lopez" class="form-control input-md" type="text" required>
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="email"></label>  
                            <div class="col-md-12">
                              <label>Correo de el/la alumno(a): </label> <label style="color:red;">*</label>
                              <input id="email" name="email" placeholder="&#128100;   juanitoperez25@outlook.com" class="form-control input-md" type="text">
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="gender"></label>
                            <div class="col-md-12">
                              <label>Género de el/la alumno(a): </label> <label style="color:red;">*</label>
                              <select id="gender" name="gender" placeholder="Selecciona un género" class="form-control input-md" required>
                                <option value="">&#128101;  Selecciona un género</option>
                                <option value="M">&#128104;  Hombre</option>
                                <option value="F">&#128105;  Mujer</option> 
                              </select>
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="career"></label>  
                            <div class="col-md-12">
                              <label>Carrera de el/la alumno(a): </label> <label style="color:red;">*</label>
                              <select id="career" name="career" placeholder="Elija la carrera" class="form-control input-md" required>
                                <option value="">&#128218;  Selecciona una carrera</option>
                                <option value="Ingeniería en Sistemas Computacionales">&#128187;  Ingeniería en Sistemas Computacionales</option>
                                <option value="Ingeniería Ambiental"> &#127811;  Ingeniería Ambiental</option> 
                                <option value="Ingeniería en Electrónica">&#129302;  Ingeniería en Electrónica</option> 
                                <option value="Ingeniería Biomédica"> &#129470;  Biomédica</option> 
                                <option value="Ingeniería en Informática">&#128190;  Ingeniería en Informática</option> 
                                <option value="Licenciatura en Administración">&#128179;  Licenciatura en Administración</option> 
                                <option value="Arquitectura">&#127968;  Arquitectura</option> 
                              </select>
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="groupnum"></label>  
                            <div class="col-md-12">
                              <label>Grupo de el/la alumno(a): </label> <label style="color:red;">*</label>
                              <input id="groupnum" name="groupnum" placeholder="&#10122;   Ej. 1234" class="form-control input-md" type="text" maxlength="4" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
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
                              <input  type="submit" class="sub" value="REGISTRAR ALUMNO" class="btn btn-primary"/>
                            </div>
                          </div>
                        </fieldset>
                      </form>
                    </div>
                    <div class="col-md-6">
                      <br><br><br><label style="color:#080C3E; font-size:32px;">ALUMNOS REGISTRADOS</label>
                      <div class="form-1-2">
                        <label style="color:#080C3E; font-size:20px;">Buscar</label>
                        <input type="text" name="search_box" id="search_box"/>
                      </div>
                      <div id="data" name="data">
                      </div>
                    </div>
                  </div>

                  '
              ;             
            }
          ?>
          <!--user end-->

          <!--feedback start-->
          <?php 
            if(@$_GET['q']==3) {
              $result = mysqli_query($con,"SELECT * FROM `feedback` ORDER BY `feedback`.`date` DESC") or die('Error');
              echo  '
              <div class="panel">
                <div class="table-responsive">
                  <table class="table table-striped title1">
                    <tr><label style="color:#080C3E; font-size:32px;">BUZÓN DE OBSERVACIONES</label>
                    <tr style="color:#879E0F; font-size:19px;">
                      <td><b>S.N.</b></td>
                      <td><b>Asunto</b></td>
                      <td><b>Matrícula</b></td>
                      <td><b>Fecha</b></td>
                      <td><b>Hora</b></td>
                      <td><b>Enviado por</b></td>
                      <td></td>
                      <td></td>
                    </tr>';
              $c=1;

              while($row = mysqli_fetch_array($result)) {
                $date = $row['date'];
                $date= date("d-m-Y",strtotime($date));
                $time = $row['time'];
                $subject = $row['subject'];
                $name = $row['name'];
                $schoolnumber = $row['schoolnumber'];
                $id = $row['id'];
	              echo '
                    <tr>
                      <td>'.$c++.'</td>';
	              echo '<td>
                        <a title="Clic para ver la observación" href="dash_teacher.php?q=3&fid='.$id.'">'.$subject.'</a>
                      </td>
                      <td>'.$schoolnumber.'</td>
                      <td>'.$date.'</td>
                      <td>'.$time.'</td>
                      <td>'.$name.'</td>
	                    <td>
                        <a title="Abrir observación" href="dash_teacher.php?q=3&fid='.$id.'">
                          <b>
                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                          </b>
                        </a>
                      </td>';
	              echo '<td>
                        <a title="Eliminar observación" href="update_teacher.php?fdid='.$id.'">
                          <b>
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                          </b>
                        </a>
                      </td>
                    </tr>';
              }

              echo '
                  </table>
                </div>
              </div>';
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
                echo '
                <div class="panel"<a title="Back to Archive" href="update_teacher.php?q1=2"><b><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span></b></a><h2 style="text-align:center; margin-top:-15px;font-family: "Ubuntu", sans-serif;"><b>'.$subject.'</b></h1>';
                echo '<div class="mCustomScrollbar" data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:450px; line-height:35px;padding:5px;"><span style="line-height:35px;padding:5px;">-&nbsp;<b>Fecha:</b>&nbsp;'.$date.'</span>
                <span style="line-height:35px;padding:5px;">&nbsp;<b>Hora:</b>&nbsp;'.$time.'</span><span style="line-height:35px;padding:5px;">&nbsp;<b>Enviado por:</b>&nbsp;'.$name.'</span><br />'.$feedback.'</div></div>';
              }
            }
          ?>
          <!--Feedback reading portion closed-->

          <!--add quiz start-->
          <?php
            if(@$_GET['q']==4 && !(@$_GET['step']) ) {
              echo ' 
              <div class="row" style= "background-image:url(image/fon.gif)">
                <br><span class="title1" style="margin-left:30%;font-size:30px;"><b style="color:#080C3E">CONFIGURACIÓN DE EXÁMEN</b></span><br /><br />
                <div class="col-md-3">
                </div>
                <div class="col-md-6">   
                  <form class="form-horizontal title1" name="form" action="update_teacher.php?q=addquiz"  method="POST">
                    <fieldset>

                      <!-- Text input-->
                      <div class="form-group"> 
                        <div class="col-md-12">
                          <br><label style="font-size: 11px; color:red;">* Campos Obligatorios</label><br>
                          <label>Número de empleado: </label>
                          <input id="emnum" name="emnum" value="'.$employnumber.'" class="form-control input-md" type="number" required readonly>    
                        </div>
                      </div>

                      <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="career"></label>  
                            <div class="col-md-12">
                              <label>Carrera: </label> <label style="color:red;">*</label>
                              <select id="career" name="career" placeholder="Elija la carrera" class="form-control input-md" required>
                                <option value="">&#128218;  Selecciona una carrera</option>
                                <option value="Ingeniería en Sistemas Computacionales">&#128187;  Ingeniería en Sistemas Computacionales</option>
                                <option value="Ingeniería Ambiental"> &#127811;  Ingeniería Ambiental</option> 
                                <option value="Ingeniería en Electrónica">&#129302;  Ingeniería en Electrónica</option> 
                                <option value="Ingeniería Biomédica"> &#129470;  Ingeniería Biomédica</option> 
                                <option value="Ingeniería en Informática">&#128190;  Ingeniería en Informática</option> 
                                <option value="Licenciatura en Administración">&#128179;  Licenciatura en Administración</option> 
                                <option value="Arquitectura">&#127968;  Arquitectura</option> 
                              </select>
                            </div>
                          </div>

                      <!-- Text input-->
                      <div class="form-group"> 
                        <div class="col-md-12">
                          <label>Asignatura a la que pertenece la evaluación: </label> <label style="color:red;">*</label>
                          <input id="subject" name="subject" placeholder="&#128218;   Ej. Calculo Diferencial" class="form-control input-md" type="text" required>    
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="form-group">  
                        <div class="col-md-12">
                          <label>TÍtulo de la evaluación: </label> <label style="color:red;">*</label>
                          <input id="name" name="name" placeholder="&#128220;   Ej. Evaluación de Primer Parcial" class="form-control input-md" type="text" required>    
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="form-group"> 
                        <div class="col-md-12">
                          <label>Evaluación para el grupo: </label> <label style="color:red;">*</label>
                          <input id="groupnumber" name="groupnumber" placeholder="&#128101;   Ej. 1951" class="form-control input-md" type="text" required maxlength="4" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">    
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="form-group">  
                        <div class="col-md-12">
                          <label>Número total de preguntas (Máximo 250): </label> <label style="color:red;">*</label>
                          <input id="total" name="total" placeholder="&#9072;  Ej. 30" class="form-control input-md" type="number" max="250" required>
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="form-group"> 
                        <div class="col-md-12">
                          <label>Fecha y Hora de inicio: </label> <label style="color:red;">*</label>
                          <input id="dateStart" name="dateStart" class="form-control input-md" type="datetime-local" required>
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="form-group">  
                        <div class="col-md-12">
                          <label>Fecha y Hora de termino: </label> <label style="color:red;">*</label>
                          <input id="dateEnd" name="dateEnd" class="form-control input-md" type="datetime-local" required>
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="form-group">  
                        <div class="col-md-12">
                          <label>Tiempo máximo de duración (en minutos): </label> <label style="color:red;">*</label>
                          <input id="time" name="time" placeholder="&#9201;   Ej. 90" class="form-control input-md" min="1" type="number" required>
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="form-group"> 
                        <div class="col-md-12">
                          <label>Descripción de la evaluación: </label> <label style="color:red;">*</label>
                          <textarea rows="8" cols="8" name="desc" class="form-control" placeholder="&#9997;   Escriba una descripción acerca de la evaluación" required></textarea>  
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-12 control-label" for=""></label>
                        <div class="col-md-12"> 
                          <input type="submit" style="margin-left:35%" class="btn btn-primary" value="CREAR EVALUACIÓN" class="btn btn-primary"/>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div';
            }
          ?>
          <!--add quiz end-->

          <!--add quiz step2 start-->
          <?php
            if(@$_GET['q']==4 && (@$_GET['step'])==2 ) {
              echo ' 
              <div class="row" style= "background-image:url(image/fon.gif)">
                <br><span class="title1" style="margin-left:29.5%;font-size:30px; color:#080C3E;"><b>FORMULACIÓN DE LAS PREGUNTAS</b></span><br /><br />
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                  <form class="form-horizontal title1" name="form" action="update_teacher.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].'&ch=4 " enctype="multipart/form-data" method="POST">
                    <fieldset>';  
                      for($i=1;$i<=@$_GET['n'];$i++) {
                        echo '<br><label style="font-size: 11px; color:red;">* Campos Obligatorios</label><br>
                              <b><label style="font-size:25px;">Pregunta &nbsp;#'.$i.'&nbsp;: </label></><br />

                        <div class="form-group row">
                          <div class="col-sm-9">
                            <label style="font-style: italic;">Valor de la pregunta (en puntos): </label> <label style="color:red">*</label>
                            <input type="number" class="form-control" id="val'.$i.'" name="val'.$i.'" placeholder="&#128202;   (Ej. 2)" min="0.01" step="0.01" style="background-color:#EEE; border:none;" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-sm-9">
                            <label style="font-style: italic;">Tema(s) de la pregunta: </label>
                            <input type="text" class="form-control" id="topic'.$i.'" name="topic'.$i.'" placeholder="&#128211;   (Ej. 3.Reglas y Búsqueda)" style="background-color:#EEE; border:none;">
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-sm-9">
                            <label style="font-style: italic;">Subtema(s) de la pregunta: </label>
                            <input type="text" class="form-control" id="subtopic'.$i.'" name="subtopic'.$i.'" placeholder="&#129534;   (Ej. 3.5 Semántica de las reglas de producción.)" style="background-color:#EEE; border:none;">
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-sm-9">
                            <label style="font-style: italic;">Objetivo de la pregunta: </label>
                            <input type="text" class="form-control" id="objective'.$i.'" name="objective'.$i.'" placeholder="&#127919;   (Ej. El alumno comprende el concepto de regla)" style="background-color:#EEE; border:none;">
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-sm-9">
                            <label style="font-style: italic;">Competencia: </label>
                            <input type="text" class="form-control" id="competence'.$i.'" name="competence'.$i.'" placeholder="&#127942;   (Ej. Capacidad de análisis y síntesis)" style="background-color:#EEE; border:none;">
                          </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                          <div class="col-sm-9">
                            <label style="font-style: italic;">Pregunta: </label><label style="color:red">*</label>
                            <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="&#9997;   Escriba la pregunta número '.$i.': " style="background-color:#EEE; border:none;"required></textarea>  
                          </div>
                        </div>

                        <!-- Image input-->
                        <div class="form-group">
                          <label class="col-md-12 control-label" for="im'.$i.' "></label>
                          <div class="col-md-12">
                            <label style="font-style: italic;">Selecciona una imagen para la pregunta '.$i.' (En caso de ser necesaria)</label>
                            <input type="file" name="im'.$i.'" accept="image/*" class="form-control" >
                          </div>
                        </div>

                        <!-- Video input-->
                        <div class="form-group">
                          <label class="col-md-12 control-label" for="vi'.$i.' "></label>
                          <div class="col-md-12">
                            <label style="font-style: italic;">Selecciona una video para la pregunta '.$i.' (En caso de ser necesaria)</label>
                            <input type="file" name="vi'.$i.'" accept="video/*" class="form-control" >
                          </div>
                        </div>

                        <!-- Audio input-->
                        <div class="form-group">
                          <label class="col-md-12 control-label" for="au'.$i.' "></label>
                          <div class="col-md-12">
                            <label style="font-style: italic;">Selecciona un audio para la pregunta '.$i.' (En caso de ser necesaria)</label>
                            <input type="file" name="au'.$i.'" accept="audio/*" class="form-control" >
                          </div>
                        </div>

                        <!-- File input-->
                        <div class="form-group">
                          <label class="col-md-12 control-label" for="do'.$i.' "></label>
                          <div class="col-md-12">
                            <label style="font-style: italic;">Selecciona un documento para la pregunta '.$i.' (En caso de ser necesaria)</label>
                            <input type="file" name="do'.$i.'" accept="file/*" class="form-control" >
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-12 control-label"></label>  
                          <div class="col-md-12">
                            <br><label style="font-style: italic;">Selecciona el tipo de respuesta:</label> <label style="color:red;">*</label>
                            <br><input type="radio" id="Pregunta cerrada'.$i.'" name="radio1'.$i.'" value="on" checked onclick="hideDivs('.$i.')">
                            <label for="closed">Respuesta cerrada</label>
                            <input type="radio" id="Pregunta verfal'.$i.'" name="radio1'.$i.'" value="on" onclick="hideDivs('.$i.')">
                            <label for="opened">Verdadero-Falso</label>
                          </div>
                        </div>

                        <div class="col-md-12" id="closed'.$i.'" name="closed">
                          <!-- Text input-->
                          <div class="form-group">
                            <br><label style="font-style: italic;">Escribe la respuesta para cada una de las opciones:</label> <label style="color:red;">*</label>
                            <br><label class="col-md-12 control-label" for="'.$i.'1"></label>  
                            a)
                            <div class="col-md-12">
                              <input id="'.$i.'1" name="'.$i.'1" placeholder="&#128240;   Escribe la respuesta de la opción A" class="form-control input-md" type="text" >
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="'.$i.'2"></label>  
                            b)
                            <div class="col-md-12">
                              <input id="'.$i.'2" name="'.$i.'2" placeholder="&#128240;   Escribe la respuesta de la opción B" class="form-control input-md" type="text">
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="'.$i.'3"></label> 
                            c) 
                            <div class="col-md-12">
                              <input id="'.$i.'3" name="'.$i.'3" placeholder="&#128240;   Escribe la respuesta de la opción C" class="form-control input-md" type="text">
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="'.$i.'4"></label>  
                            d)
                            <div class="col-md-12">
                              <input id="'.$i.'4" name="'.$i.'4" placeholder="&#128240;   Escribe la respuesta de la opción D" class="form-control input-md" type="text">
                            </div>
                          </div>

                          <br />
                          <b style="font-style: italic;">Selecciona la respuesta correcta</b>:<label style="color:red;">*</label><br/> 
                          <select id="ans'.$i.'" name="ans'.$i.'" placeholder="Seleciona la respuesta correcta" class="form-control input-md" >
                            <option value="">Seleccione la respuesta correcta de la pregunta '.$i.'</option>
                            <option value="a">Opción a</option>
                            <option value="b">Opción b</option>
                            <option value="c">Opción c</option>
                            <option value="d">Opción d</option> 
                          </select><br /><br />
                        </div>

                        <div class="col-md-12" id="truefalse'.$i.'" name="truefalse">
                          <!-- Text input-->
                          <b>Escoge la respuesta correcta</b>:<br/>
                          <select id="tfans'.$i.'" name="tfans'.$i.'" placeholder="Elige la respuesta correcta " class="form-control input-md" >
                            <option value="">Seleccione la respuesta correcta a la pregunta '.$i.'</option>
                            <option value="tr">Verdadero</option>
                            <option value="fal">Falso</option>
                          </select><br /><br />
                        </div>

                        <div class="form-group">
                          <label class="col-md-12 control-label">&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;</label>
                        </div>
                        '; 
                      }
                      echo '
                      <div class="form-group">
                        <label class="col-md-12 control-label" for=""></label>
                        <div class="col-md-12"> 
                          <input  type="submit" style="margin-left:35%" class="btn btn-primary" value="CREAR PREGUNTAS" class="btn btn-primary"/>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>';
            }
          ?>
          <!--add quiz step 2 end-->

          <!--remove quiz-->
          <?php 
            if(@$_GET['q']==5) {
              $result = mysqli_query($con,"SELECT * FROM quiz WHERE employnumber = $employnumber ORDER BY subject DESC") or die('Error');
              echo  '
              <div class="panel">
                <div class="table-responsive">
                  <table class="table table-striped title1">
                    <label style="color:#080C3E; font-size:31px;"> MIS EVALUACIONES CREADAS</label>
                    <tr style="color:#879E0F; font-size:18px;">
                      <td><b>S.N.</b></td>
                      <td><b>Asignatura</b></td>
                      <td><b>Título de la evaluación</b></td>
                      <td><b>Grupo</b></td>
                      <td><b>Total de Preguntas</b></td>
                      <td><b>Descripción</b></td>
                      <td><b>Fecha de creación</b></td>
                      <td></td>
                    </tr>';
              $c=1;

              while($row = mysqli_fetch_array($result)) {
                $subject = $row['subject'];
                $title = $row['title'];
                $group = $row['groupnum'];
                $total = $row['total'];
                $descrip = $row['description'];
                $dt = $row['date'];
                $eid = $row['eid'];	

                echo '
                    <tr>
                      <td>'.$c++.'</td>
                      <td>'.$subject.'</td>
                      <td>'.$title.'</td>
                      <td>'.$group.'</td>
                      <td>'.$total.'</td>
                      <td>'.$descrip.'</td>
                      <td>'.$dt.'&nbsp;min</td>
                      <td>
                        <b>
                          <a href="update_teacher.php?q=rmquiz&eid='.$eid.'" class="pull-right btn sub1" style="margin:0px;background:lightskyblue">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;
                            <span class="title1">
                              <b>Eliminar Evaluación</b>
                            </span>
                          </a>
                        </b>
                      </td>
                    </tr>';
              }
              $c=0;
              echo '
                  </table>
                </div>
              </div>';
            }
          ?>

          <!--Información personal-->
          <?php
            if(@$_GET['q']== 6){
               echo '
                <div class="row">
                  <div class="col-md-8 pull-left">
                    <h1 style="font-style: bold; color:#080C3E; font-size:35px; ">MI INFORMACIÓN PERSONAL</h1> 
                  </div>
                </div>

                <br><div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Número de empleado:</label>
                      <span class="form-control sin_borde" id="span_employnumber">'.$employnumber.'</span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Nombre(s) y Apellidos:</label>
                      <span class="form-control sin_borde" id="span_name">'.$name.'</span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-8 pull-left">
                    <br><br><h4><label style="color:black;">NOTA:</label>   Si existe algún error póngase en contacto con el administrador.</h4> 
                  </div>
                </div>
                ';
            }
          ?>

          <!--Change Password-->
          <?php
            if(@$_GET['q']== 7){
              echo '
                <div class="row">
                  <div class="col-md-8 pull-left">
                    <br><h1 style="color:#080C3E;">CAMBIO DE CONTRASEÑA</h1><br>  
                  </div>
                </div>

                <form class="form-horizontal" name="form" action="update_teacher.php?q=pass&employnumber='.$employnumber.'" method="POST">
                  <fieldset>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Contraseña actual:</label> <label style="color:red;">*</label>
                          <input class="form-control required" id="actpass" name="actpass" type="password">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Nueva contraseña:</label> <label style="color:red;">*</label>
                          <input class="form-control required" id="newpass" name="newpass" type="password">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Confirma nueva contraseña:</label> <label style="color:red;">*</label>
                          <input class="form-control required" id="cnewpass" name="cnewpass" type="password">
                        </div>
                      </div>
                    </div>';

              if(@$_GET['q8']){
                echo'
                    <p style="color:red;font-size:15px;">'.@$_GET['q8'];
              }

              echo '<!-- Button -->
                    <div class="row">
                      <label class="col-md-4 control-label" for=""></label>
                      <div class="col-md-4"> 
                        <input  type="submit" class="sub" value="ACTUALIZAR" class="btn btn-primary"/>
                      </div>
                    </div>
                  </fieldset>
                </form>

                <div class="row">
                  <div class="col-md-8 pull-left">
                    <label style="font-size: 11px; color:red;">* Campos obligatorios</label>
                  </div>
                </div>
                ';
            }
          ?>
        </div><!--container closed-->
      </div>
    </div>
  </body>
</html>
