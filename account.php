<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>TestLine | |
    Tecnológico de Estudios Superiores de Ixtapaluca
  </title>

  <link rel="shortcut icon" href="image/logo.png" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/font.css">
  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <script src="js/Crono.js" type="text/javascript"></script>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

  <!--alert message-->
  <?php if (@$_GET['w']) {
    echo '<script>alert("' . @$_GET['w'] . '");</script>';
  } ?>
  <!--alert message end-->

  <script>
    function validateForm() {
      var a = document.forms["form"]["newpass"].value;
      if (a == null || a == "") {
        alert("Escriba una nueva contraseña");
        return false;
      }
      if (a.length < 5 || a.length > 25) {
        alert("La contraseña debe tener una extensión entre 5 y 25 caracteres");
        return false;
      }
    }
  </script>
</head>
<?php
include_once 'dbConnection.php';
?>

<body style="background-image: url(image/background.png);">
  <div class="header">
    <div class="row">
      <div class="col-lg-6">
        <span class="logo">TestLine TESI</span>
      </div>
      <div class="col-md-4 col-md-offset-2">
        <?php
        include_once 'dbConnection.php';
        session_start();
        if (!(isset($_SESSION['schoolnumber']))) {
          header("location:index.php");
        } else {
          $name = $_SESSION['name'];
          $last_name = $_SESSION['last_name'];
          $schoolnumber = $_SESSION['schoolnumber'];
          $career = $_SESSION['career'];
          $grnum = $_SESSION['groupnum'];

          include_once 'dbConnection.php';
          echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hola ' . $name . '</span> &nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Cerrar Sesión</button></a></span>';
        }
        ?>
      </div>
    </div>
  </div>

  <div class="bg">
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
          <a class="navbar-brand" href="account.php?q=1">
            <b>TestLine TESI</b>
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li <?php if (@$_GET['q'] == 1) echo 'class="active"'; ?>><a href="account.php?q=1"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>&nbsp;Evaluaciones<span class="sr-only">(current)</span></a></li>
            <li <?php if (@$_GET['q'] == 2 || @$_GET['q'] == 'quizresul') echo 'class="active"'; ?>><a href="account.php?q=2"><span class="glyphicon glyphicon-saved" aria-hidden="true"></span>&nbsp;Calificaciones</a></li>
            <li class="dropdown <?php if (@$_GET['q'] == 4 || @$_GET['q'] == 5 || @$_GET['q'] == 6) echo 'active"'; ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;Datos personales</a>
              <ul class="dropdown-menu">
                <li><a href="account.php?q=4">Información personal</a></li>
                <li><a href="account.php?q=5">Cambiar correo electrónico</a></li>
                <li><a href="account.php?q=6">Cambiar contraseña</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <!--navigation menu closed-->

    <div class="container">
      <!--container start-->
      <div class="row">
        <div class="col-md-12">

          <!--home start-->
          <?php if (@$_GET['q'] == 1) {
            $conuser = mysqli_query($con, "SELECT * FROM user WHERE schoolnumber= '$schoolnumber'") or die('Error');
            $count = mysqli_num_rows($conuser);
            if ($count == 1) {
              while ($row = mysqli_fetch_array($conuser)) {
                $groupnum = $row['groupnum'];
              }
            }

            $result = mysqli_query($con, "SELECT * FROM quiz WHERE groupnum = '$groupnum' ORDER BY date DESC") or die('Error');
            echo  '
              <div class="panel">
                <div class="table-responsive">
                  <table class="table table-striped title1">
                    <label style="color:#080C3E; font-size:31px;"> EVALUACIONES </label>
                    <tr style="color:#879E0F; font-size:18px;">
                      <td><b>S.N.</b></td>
                      <td><b>Título de la evaluación</b></td>
                      <td><b>Asignatura</b></td>
                      <td><b>Total de Preguntas</b></td>
                      <td><b>Descripción</b></td>
                      <td><b>Tiempo Límite</b></td>
                      <td><b>Fecha de Inicio</b></td>
                      <td><b>Fecha de Termino</b></td>
                    </tr>';
            $c = 1;

            date_default_timezone_set('America/Mexico_City');
            $actual_date = date("Y-m-d H:i:s");

            while ($row = mysqli_fetch_array($result)) {
              $title = $row['title'];
              $sub = $row['subject'];
              $total = $row['total'];
              $intro = $row['description'];
              $time = $row['time'];
              $eid = $row['eid'];
              $sd = $row['start_date'];
              $fd = $row['final_date'];
              $q12 = mysqli_query($con, "SELECT total_score FROM qualification WHERE eid='$eid' AND schoolnumber='$schoolnumber'") or die('Error98');
              $rowcount = mysqli_num_rows($q12);

              if ($actual_date > $sd && $actual_date < $fd) {
                if ($rowcount == 0) {
                  echo '
                      <tr>
                        <td>' . $c++ . '</td>
                        <td>' . $title . '</td>
                        <td>' . $sub . '</td>
                        <td>' . $total . '</td>
                        <td>' . $intro . '</td>
                        <td>' . $time . '&nbsp;min</td>
                        <td>' . $sd . '</td>
                        <td>' . $fd . '</td>
                        <td>
                          <b>
                            <a href="account.php?q=quiz2&eid=' . $eid . '&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32">
                              <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;
                              <span class="title1">
                                <b>Iniciar</b>
                              </span>
                            </a>
                          </b>
                        </td>
                      </tr>';
                } else {
                  echo '
                      <tr>
                        <td>' . $c++ . '</td>
                        <td>' . $title . '&nbsp;
                          <span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true">
                          </span>
                        </td>
                        <td>' . $sub . '</td>
                        <td>' . $total . '</td>
                        <td>' . $intro . '</td>
                        <td>' . $time . '&nbsp;min</td>
                        <td>' . $sd . '</td>
                        <td>' . $fd . '</td>
                        <td style="color:BLUE;">EVALUACIÓN RESUELTA. CONSULTA TUS CALIFICACIONES</td>
                      </tr>';
                }
              }
            }
            $c = 0;
            echo '
                  </table>
                </div>
              </div>';
          } ?>

          <!--result display-->
          <?php
          //result display
          if (@$_GET['q'] == 'result' && @$_GET['eid']) {
            $eid = @$_GET['eid'];
            $q = mysqli_query($con, "SELECT * FROM qualification WHERE eid='$eid' AND schoolnumber='$schoolnumber' ") or die('Error157');
            echo  '<div class="panel">
                <center><h1 class="title" style="color:#660033">RESULTADOS DE LA EVALUACIÓN</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

            while ($row = mysqli_fetch_array($q)) {
              $s = $row['final_score'];
              $w = $row['wrong_ans'];
              $r = $row['right_ans'];
              $qa = $row['total_score'];
              echo '<tr style="color:blue"><td>Puntaje Máximo</td><td>' . $qa . '</td></tr>
                  <tr style="color:#879E0F"><td>Respuestas Correctas&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>' . $r . '</td></tr> 
	                <tr style="color:red"><td>Respuestas Equivocadas&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>' . $w . '</td></tr>
	                <tr style="color:#080C3E"><td>PUNTAJE OBTENIDO EN LA PRUEBA&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>' . $s . '</td></tr>';
            }
            echo '</table>
              <a href="account.php?q=1" class="pull-right btn sub1" style="margin:0px;background:#435e7c">
                <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;
                <span class="title1">
                  <b>Regresar</b>
                </span>
              </a>&nbsp;

              <b>
                <a href="generate_pdf/generatestudent_pdf.php?eid='.$eid.'&scn='.$schoolnumber.'" target="_blank" class="pull-right btn sub1" style="margin:0px;background:#64D852;width:150px;">
                  <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>&nbsp;
                  <span class="title1">
                    <b>Evidencia</b>
                  </span>
                </a>
              </b> 
              
            </div>';
          }
          ?>
          <!--result end-->

          <!--quiz start-->
          <?php
          if (@$_GET['q'] == 'quiz2') {
            $eid=@$_GET['eid'];
            $sn=@$_GET['n'];
            $total=@$_GET['t'];
            $q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
            $q2=mysqli_query($con,"SELECT * FROM results WHERE eid='$eid' AND schoolnumber='$schoolnumber' " );
            $count = mysqli_num_rows($q2);

            if($count == 0){

              $q3 = mysqli_query($con, "SELECT * FROM quiz WHERE eid = '$eid'");
              while($row3 = mysqli_fetch_array($q3)){
                $left_time = $row3['time'];
              }
            }
            else{
              while($row2 = mysqli_fetch_array($q2)){
                $left_time = $row2['left_time'];
              }
            }

            echo'
            <script>
              start('.$left_time.');
            </script>
            ';


            echo '
            <div class="row">
              <div class="col-md-10">
              </div>
              <div class="col-md-2" id="count">
                Tiempo restante:                 
              </div>
            </div>
            <div class="qPanel" style="margin:5%">';

            while($row=mysqli_fetch_array($q) ){
              $qns=$row['qns'];
              $qid=$row['qid'];
              $im=$row['image'];
              $vi=$row['video'];
              $extVi = explode(".", $vi);
              $au=$row['audio'];
              $extAu = explode(".", $au);
              $do=$row['doc'];
              $qtopic=$row['topic'];
              $qsubtopic=$row['subtopic'];
              $qobjective=$row['objective'];
              $qcompetence=$row['competence'];
              $qval=$row['qval'];

              echo '
              <div class="qQtn">
                <b>Pregunta &nbsp;'.$sn.':</b> '.$qns.'                        
                <br />
              </div>
              <br />'; 
                    
              echo'
              <div class="qInfo">
                <b>Tema: </b> '.$qtopic.'
                <br /><b>Subtema: </b> '.$qsubtopic.'
                <br /><b>Objetivo: </b> '.$qobjective.'
                <br /><b>Competencia: </b> '.$qcompetence.'<br />
                <b>Valor: '.$qval.' pts.</b><br />
              </div>
              <br />'; 

              if($im !== "no image"){
                echo '<div>
                        <img src="teach-adm/qimage/'.$im.'" style="max-width:50%;width:auto;height:auto;">
                      </div><br />';
              }
              if($vi !== "no video"){
                echo '<div>
                        <video style="max-width:50%;width:auto;height:auto;" controls>
                          <source src="teach-adm/qvideo/'.$vi.'" type="video/'.$extVi[1].'" >
                          Tu buscador no es compatible con el contenido Video
                        </video>
                      </div><br />';
              }
              if($au !== "no audio"){
                echo '<div>
                        <audio controls>
                          <source src="teach-adm/qaudio/'.$au.'" type="audio/'.$extAu[1].'">
                          Tu buscador no es compatible con el contenido Audio
                        </audio>
                      </div><br />';
              }
              if($do !== "no file"){
                echo '<div>
                        <embed src="teach-adm/qdoc/'.$do.'" type="application/pdf" width="100%" height="600px" />
                      </div><br />';
              }
            }

            echo '
              <form action="update_student.php?q=answer&eid='.$eid.'&qid='.$qid.'&n='.$sn.'&t='.$total.'&scn='.$schoolnumber.'" method="POST">';

            $q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
            echo'<div class="qOpt">
                  <input type="hidden" name="time" id="time" value="'.$left_time.'">';

            while($row=mysqli_fetch_array($q) ){
              $qtype=$row['qtype'];
              
              if($qtype=='trfl' || $qtype=='closed'){
                $option=$row['option'];
                $optionid=$row['optionid'];
                $ansid = "vacio";
                $qans=mysqli_query($con,"SELECT * FROM results WHERE eid='$eid' AND qid='$qid' AND schoolnumber ='$schoolnumber'" );
                
                while($row=mysqli_fetch_array($qans) ){
                  $ansid=$row['studentansid'];
                }

                if($ansid == $optionid){
                  echo'<input type="radio" id="ans'.$sn.'" name="ans'.$sn.'" value="'.$optionid.'" checked>'.$option.'<br />';
                }
                else{
                  echo'<input type="radio" id="ans'.$sn.'" name="ans'.$sn.'" value="'.$optionid.'">'.$option.'<br />';           
                }
              }
              else{
                $option=$row['option'];
                $optionid=$row['optionid'];
                echo'<input type="text" id="ansop'.$sn.'" name="ansop'.$sn.'" placeholder="Escribe tu respuesta aqui..." style="width: 500px;" ><br />';
              }
            }
            echo'</div>';
            echo '
            <br />
                <div id="botonera">';  

            $qPagi = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' " );
            $countPagi = mysqli_num_rows($qPagi);
            $limit = 10;

            echo' <ul class="pagination pagination-sm">'; 

            if(($countPagi-$limit)>=1){
              if(($sn+$limit)>$countPagi){
                for($i=$sn; $i<=$countPagi; $i++){
                  echo'
                        <li><a href="account.php?q=quiz2&eid='.$eid.'&n='.$i.'&t=1">'.$i.'</a></li>';
                }
              }
              else{
                for($i=$sn; $i<$sn+$limit; $i++){
                  echo'
                        <li><a href="account.php?q=quiz2&eid='.$eid.'&n='.$i.'&t=1">'.$i.'</a></li>';
                }
              }
            }else{
              for($i=1; $i<=$countPagi; $i++){
                echo'
                      <li><a href="account.php?q=quiz2&eid='.$eid.'&n='.$i.'&t=1">'.$i.'</a></li>';
              }
            }
            echo' </ul>';

            if($sn==1){
              if($sn == $total){
                echo'
                  <div class="row">
                    <div class="col-md-10">
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary" id="finish_btn" name="finish_btn" value="FINALIZAR">
                        FINALIZAR
                        <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                      </button>
                    </div>
                  </div>';
              }
              else{
                echo'
                  <div class="row">
                    <div class="col-md-10">
                    <ul class="pagination pagination-sm">
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                    </ul>
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary" id="question" name="question" value="SIGUIENTE">
                        SIGUIENTE
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>&nbsp;
                      </button>
                    </div>
                  </div>';
              }
              
            }
            elseif($sn>1 && $sn < $total){
              echo'
                  <div class="row">
                    <div class="col-md-10">
                      <button type="submit" class="btn btn-primary" id="question" name="question" value="ANTERIOR">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>&nbsp;
                        ANTERIOR
                      </button>
                      <ul class="pagination pagination-sm">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                      </ul>
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary" id="question" name="question" value="SIGUIENTE">
                        SIGUIENTE
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>&nbsp;
                      </button>
                    </div>
                  </div>';
            }
            else{
              echo'
                  <div class="row">
                    <div class="col-md-10">
                      <button type="submit" class="btn btn-primary" id="question" name="question" value="ANTERIOR">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>&nbsp;
                        ANTERIOR
                      </button>
                      <ul class="pagination pagination-sm">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                      </ul>
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary" id="finish_btn" name="finish_btn" value="FINALIZAR">
                        FINALIZAR
                        <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                      </button>
                    </div>
                  </div>';
            }

            echo '
                </div>
              </form>
            </div>';
          }
          ?>

          <!--quiz end-->
          <?php

          //history start
          if (@$_GET['q'] == 2) {
            $q = mysqli_query($con, "SELECT * FROM qualification WHERE schoolnumber='$schoolnumber' ORDER BY date DESC ") or die('Error197');
            echo  '
                <div class="panel">
                  <div class="table-responsive">  
                    <table class="table table-striped title1" >
                      <label style="color:#080C3E; font-size:31px;">RESULTADOS</label>
                      <tr style="color:#879E0F; font-size:18px;">
                        <td><b>S.N.</b></td>
                        <td><b>Título de la evaluación</b></td>
                        <td><b>Puntaje Máximo</b></td>
                        <td><b>Puntaje Obtenido</b></td>
                        <td><b>Respuestas Correctas<b></td>
                        <td><b>Respuestas Incorrectas</b></td>
                        <td><b>Porcentaje Obtenido<b></td>
                      </tr>';
            $c = 0;

            while ($row = mysqli_fetch_array($q)) {
              $eid = $row['eid'];
              $ts = $row['total_score'];
              $w = $row['wrong_ans'];
              $r = $row['right_ans'];
              $fs = $row['final_score'];
              $pc = $row['porcent'];
              $q23 = mysqli_query($con, "SELECT * FROM quiz WHERE  eid='$eid' ") or die('Error208');

              while ($row = mysqli_fetch_array($q23)) {
                $title = $row['title'];
                $final_date = $row['final_date'];
              }

              date_default_timezone_set('America/Mexico_City');
              $actual_date = date("Y-m-d H:i:s");

              $c++;
              if ($actual_date > $final_date) {
                echo '
                      <tr>
                        <td>' . $c . '</td>
                        <td>' . $title . '</td>
                        <td>' . $ts . '</td>
                        <td>' . $fs . '</td>
                        <td>' . $r . '</td>
                        <td>' . $w . '</td>
                        <td>' . $pc . '%</td>
                        <td>
                          <b>
                            <a href="account.php?q=quizresul&eid=' . $eid . '&schnum=' . $schoolnumber . '" class="pull-right btn sub1" style="margin:0px;background:#4482AB; width:155px;">
                              <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;
                              <span class="title1">
                                <b>Ver resultados</b>
                              </span>
                            </a>
                          </b>&nbsp;
                          <b>
                            <a href="generate_pdf/generatestudent_pdf.php?eid='.$eid.'&scn='.$schoolnumber.'" target="_blank" class="pull-right btn sub1" style="margin:0px;background:#64D852;width:150px;">
                              <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>&nbsp;
                              <span class="title1">
                                <b>Evidencia</b>
                              </span>
                            </a>
                          </b> 
                        </td>
                      </tr>';
              } else {
                echo '
                      <tr>
                        <td>' . $c . '</td>
                        <td>' . $title . '</td>
                        <td>' . $ts . '</td>
                        <td>' . $fs . '</td>
                        <td>' . $r . '</td>
                        <td>' . $w . '</td>
                        <td>' . $pc . '%</td>
                        <td>Respuestas disponibles despues de la fecha de termino.</td>
                      </tr>';
              }
            }
            echo '
                    </table>
                  </div>
                </div>';
          }
          ?>

          <!--Consultar resultados, preguntas y respuestas-->
          <?php
          if (@$_GET['q'] == 'quizresul') {
            $eid = @$_GET['eid'];
            $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid'");
            while ($row = mysqli_fetch_array($q)) {
              $total = $row['total'];
            }

            echo '
                <div class="panel" style="margin:5%">
                  <label style="color:#080C3E; font-size:31px; text-align:center;">MIS RESULTADOS</label><br>
                  <br />';

            for ($i = 1; $i <= $total; $i++) {
              $q = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid' AND sn='$i' ");

              while ($row = mysqli_fetch_array($q)) {
                $qns = $row['qns'];
                $qid = $row['qid'];
                $im = $row['image'];
                $qtopic = $row['topic'];
                $qsubtopic = $row['subtopic'];
                $qobjective = $row['objective'];
                $qcompetence = $row['competence'];
                $qval = $row['qval'];
                echo '<label style="color:green;">&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;&#8887;</label> <br><br>
                        <b>Tema: </b> ' . $qtopic . '
                    <br /><b>Subtema: </b> ' . $qsubtopic . '
                    <br /><b>Objetivo: </b> ' . $qobjective . '
                    <br /><b>Competencia: </b> ' . $qcompetence . '<br /><br />
                    <b>Valor: ' . $qval . ' pts.</b>';

                echo '<div>
                          <b>Pregunta &nbsp;' . $i . ':</b> ' . $qns . '                        
                          <br />
                          <br />';

                if ($im !== "no image") {
                  echo '<div>
                              <img src="qimage/' . $im . '" style="max-width:40%;width:auto;height:auto;">
                            </div>';
                }
              }

              $q = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid' ");

              while ($row = mysqli_fetch_array($q)) {

                $qtype = $row['qtype'];
                if ($qtype == 'closed') {
                  $option = $row['option'];
                  $optionid = $row['optionid'];

                  $q2 = mysqli_query($con, "SELECT * FROM results WHERE qid='$qid' AND schoolnumber='$schoolnumber'");
                  while ($row = mysqli_fetch_array($q2)) {
                    $ansid = $row['ansid'];
                    $studentansid = $row['studentansid'];

                    if ($studentansid == $optionid) {
                      if ($studentansid == $ansid) {
                        echo '
                            <div style="background-color:#99F975">
                              <input type="radio" id="ans' . $i . '" name="ans' . $i . '" value="' . $optionid . '" disabled checked>' . $option . '
                            </div><br /><br />';
                      } else {
                        echo '
                            <div style="background-color:#F49393">
                              <input type="radio" id="ans' . $i . '" name="ans' . $i . '" value="' . $optionid . '" disabled>' . $option . '
                            </div><br /><br />';
                      }
                    } else {
                      if ($ansid == $optionid) {
                        echo '
                            <div style="background-color:#99F975">
                              <input type="radio" id="ans' . $i . '" name="ans' . $i . '" value="' . $optionid . '" disabled>' . $option . '
                            </div><br /><br />';
                      } else {
                        echo '
                            <div>
                              <input type="radio" id="ans' . $i . '" name="ans' . $i . '" value="' . $optionid . '" disabled>' . $option . '
                            </div><br /><br />';
                      }
                    }
                  }
                } elseif ($qtype == 'trfl') {
                  $option = $row['option'];
                  $optionid = $row['optionid'];

                  $q2 = mysqli_query($con, "SELECT * FROM results WHERE qid='$qid' AND schoolnumber='$schoolnumber'");
                  while ($row = mysqli_fetch_array($q2)) {
                    $ansid = $row['ansid'];
                    $studentansid = $row['studentansid'];

                    if ($studentansid == $optionid) {
                      if ($studentansid == $ansid) {
                        echo '
                            <div style="background-color:#99F975">
                              <input type="radio" id="tfans' . $i . '" name="tfans' . $i . '" value="' . $optionid . '" disabled checked>' . $option . '
                            </div><br /><br />';
                      } else {
                        echo '
                            <div style="background-color:#F49393">
                              <input type="radio" id="tfans' . $i . '" name="tfans' . $i . '" value="' . $optionid . '" disabled>' . $option . '
                            </div><br /><br />';
                      }
                    } else {
                      if ($ansid == $optionid) {
                        echo '
                            <div style="background-color:#99F975">
                              <input type="radio" id="tfans' . $i . '" name="tfans' . $i . '" value="' . $optionid . '" disabled>' . $option . '
                            </div><br /><br />';
                      } else {
                        echo '
                            <div>
                              <input type="radio" id="tfans' . $i . '" name="tfans' . $i . '" value="' . $optionid . '" disabled>' . $option . '
                            </div><br /><br />';
                      }
                    }
                  }
                } else {
                  $option = $row['option'];
                  $optionid = $row['optionid'];
                  $q2 = mysqli_query($con, "SELECT * FROM results WHERE qid='$qid' AND schoolnumber='$schoolnumber'");
                  while ($row = mysqli_fetch_array($q2)) {
                    $roption = $row['option'];
                  }
                  echo '<br /><b>RESPUESTA CORRECTA: </b> ' . $option . ' ';
                  if ($option == $roption) {
                    echo '
                        <div>
                          <br /><b>Tu Respuesta: </b> <label style="background-color:#99F975"> ' . $roption . '</label>
                        </div>';
                  } else {
                    echo '
                        <div>
                          <br /><b>Tu respuesta: </b><label style="background-color:#F49393"> ' . $roption . '</label>
                        </div>';
                  }
                }
              }
              echo '</div><br /><br /><br />';
            }
            echo '
                  <b>
                    <a href="account.php?q=2" class="pull-right btn sub1" style="margin:0px;background:#9B9999; width:130px;">
                      <span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;
                      <span class="title1">
                        <b>REGRESAR</b>
                      </span>
                    </a>
                  </b>
                </div>';
          }
          ?>
          <!--Observaciones-->
          <?php
          if (@$_GET['q'] == 3) {
            echo ' 
                <br><label style="color:#080C3E; font-size:35px;"> ENVIANOS TUS OBSERVACIONES</label>
                <br><br>Puedes enviarnos un email al siguiente correo: <label style="color:blue;">div.ing.sistemas@tesi.edu.mx</label><br />
                <div class="row">
                  <div class="col-md-1">
                  </div>
                  <div class="col-md-10">
                  </div>
                  <div class="col-md-1">
                  </div>
                </div>
                <p>O sencillamente puedes llenar el siguiente formulario</p>
                <form role="form"  method="post" action="feed.php">
                  <div class="row">
                    <br><br><div class="col-md-3"><b>Nombre:</b><br /><br /><br /><b>Matrícula</b><br /><br /><br /><b>Asunto:</b></div>
                    <div class="col-md-9">
                      <!-- Text input-->
                      <div class="form-group">
                        <input id="name" name="name" value="' . $name . '" class="form-control input-md" type="text" required readonly><br />  
                        <input id="schoolnumber" name="schoolnumber" value=' . $schoolnumber . ' class="form-control input-md" type="number" required readonly><br />  
                        <input id="subject" name="subject" placeholder="Ej. Corrección de Matricula" class="form-control input-md" type="text" required>    
                      </div>
                    </div>
                  </div><!--End of row-->

                  <div class="form-group"> 
                    <textarea rows="5" cols="8" name="feedback" class="form-control" placeholder="Escribe tus observaciones aquí..." required></textarea>
                  </div>

                  <div class="form-group" align="center">
                    <input type="submit" name="submit" value="ENVIAR OBSERVACIONES" class="btn btn-primary" />
                  </div>
                </form>';
          }
          ?>

          <!--Información personal-->
          <?php
          if (@$_GET['q'] == 4) {
            echo '<div class="row">
                    <div class="col-md-8 pull-left">
                      <h1 style="font-style: bold; color:#080C3E; font-size:35px; ">MI INFORMACIÓN PERSONAL</h1>  
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Matrícula:</label>
                        <span class="form-control sin_borde" id="span_schoolnumber">' . $schoolnumber . '</span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Nombre(s):</label>
                        <span class="form-control sin_borde" id="span_name">' . $name . '</span>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Apellidos:</label>
                        <span class="form-control sin_borde" id="span_last_name">' . $last_name . '</span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Carrera:</label>
                        <span class="form-control sin_borde" id="span_career">' . $career . '</span>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Grupo:</label>
                        <span class="form-control sin_borde" id="span_group">' . $grnum . '</span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-8 pull-left">
                      <h4><label style="color:black;">NOTA:</label>  Si existe algún error o duda puedes enviar un mensaje en el apartado observaciones.De igual forma puedes solicitar ayuda a alguno de tus profesores.</h4> 
                    </div>
                  </div>';
          }
          ?>

          <!--Change email-->
          <?php
            if (@$_GET['q'] == 5) {
              $q = mysqli_query($con, "SELECT email FROM user WHERE schoolnumber=$schoolnumber") or die('Error mail');
              while($row = mysqli_fetch_array($q)){
                $email = $row['email'];
              }
  
              echo '<div class="row">
                      <div class="col-md-8 pull-left">
                        <h1 style="font-style: bold; color:#080C3E; font-size:35px; ">CORREO ELECTRÓNICO</h1>  
                      </div>
                    </div>
  
                    <form class="form-horizontal" name="form" action="update_student.php?q=mail&schoolnumber=' . $schoolnumber . '" method="POST">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Correo electrónico del alumno:</label> <label style="color:red;">*</label>
                            <input class="form-control required" id="usermail" name="usermail" type="email" value="'.$email.'">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4"> 
                        <input  type="submit" class="btn btn-primary" value="GUARDAR" class="btn btn-primary"/>
                      </div>';
                      if (@$_GET['q7']) {
                        echo '<p style="color:red;font-size:15px;">' . @$_GET['q7'];
                      }
              echo'<br />
                    </form>';
            }
          ?>

          <!--Change Password-->
          <?php
          if (@$_GET['q'] == 6) {
            echo '<div class="row">
                        <div class="col-md-8 pull-left">
                          <br><h1 style="color:#080C3E;">CAMBIO DE CONTRASEÑA</h1><br>   
                        </div>
                      </div>

                      <form class="form-horizontal" name="form" action="update_student.php?q=pass&schoolnumber=' . $schoolnumber . '" onSubmit="return validateForm()" method="POST">
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

            if (@$_GET['q7']) {
              echo '<p style="color:red;font-size:15px;">' . @$_GET['q7'];
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

        </div>
      </div>
    </div>
  </div>

  <!--Footer start-->
  <div class="row footer">
    <div class="col-md-3 box">
      <a href="https://tesi.org.mx/" target="_blank">Página principal del Tecnológico</a>
    </div>
    <div class="col-md-3 box">
      <a href="account.php?q=3">Observaciones</a>
    </div>
  </div>
  <!--footer end-->
</body>

</html>