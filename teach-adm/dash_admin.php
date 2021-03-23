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
    <script src="js/search_jefe.js" type="text/javascript"></script>
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
          alert("¡¡¡Es Necesario Escribir El Nombre!!!");
          return false;
        }        
        var x = document.forms["form"]["password"].value;
        if(x.length<5){
          alert("¡¡¡La Contraseña Debe Estar Conformada Por Al Menos 5 Caracteres!!!");
          return false;
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
          if(!(isset($_SESSION['user']))){
            header("location:index.php");
          }
          else{
            $name = $_SESSION['user'];
            include_once '../dbConnection.php';
            echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hola '.$name.'</span> &nbsp;|&nbsp;<a href="logout_admin.php?q=dash_admin.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Cerrar Sesión</button></a></span>';
          }
        ?>
      </div>
    </div>

    <!-- admin start-->

    <!--navigation menu-->
    <nav class="navbar navbar-default title1">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
         <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
          </button>
          <a class="navbar-brand" href="dash_admin.php?q=1">
            <b>TestLine TESI&nbsp;</b>
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="dash_admin.php?q=1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Jefes de Carrera<span class="sr-only">(current)</span></a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav><!--navigation menu closed-->

    <div class="container"><!--container start-->
      <div class="row">
        <div class="col-md-12">
         
          <!--teacher start-->
          <?php 
            if(@$_GET['q']==1) {

              echo '
                  <div class="row">
                    <div class="col-md-4 panel">
                      <form class="form-horizontal" name="form" action="sign_jefe.php" onSubmit="return validateForm()" method="POST">
                        <h4 style="color:#879E0F; font-size:30px; margin-top:-13px;">REGISTRO DE JEFES DE CARRERA</h4><br>
                        <fieldset>
                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="name"></label>  
                            <div class="col-md-12">
                              <label style="font-size: 10px; color:red;">* Campos obligatorios</label>
                              <label>Nombre completo del jefe de carrera: </label> <label style="color:red;">*</label>
                              <input id="name" name="name" placeholder="&#128100;   Ej. Juan Ignacio Perez Lopez" class="form-control input-md" type="text">
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label title1" for="career"></label>
                            <div class="col-md-12">
                              <label>Carrera: </label> <label style="color:red;">*</label>
                              <input id="career" name="career" placeholder="&#128218;  Ingeniería Mecanica" class="form-control input-md" type="text" maxlength="50" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="email"></label>  
                            <div class="col-md-12">
                              <label>Correo de el/la jefe(a) de carrera: </label> <label style="color:red;">*</label>
                              <input id="email" name="email" placeholder="&#128100;   juanitoperez25@outlook.com" class="form-control input-md" type="text">
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-12 control-label" for="password"></label>  
                            <div class="col-md-12">
                              <label>Contraseña asignada: </label> <label style="color:red;">*</label>
                              <input id="password" name="password" placeholder="&#128273;  **********" class="form-control input-md" type="password">
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
                              <input  type="submit" class="sub" value="REGISTRAR JEFE DE CARRERA" class="btn btn-primary"/>
                            </div>
                          </div>
                        </fieldset>
                      </form>
                    </div>
                    <div class="col-md-6">
                      <label style="color:#080C3E; font-size:32px;">JEFES DE CARRERA REGISTRADOS</label>
                      <div class="form-1-2">
                        <label style="color:#080C3E; font-size:20px;">Buscar</label>
                        <input type="text" name="search_box" id="search_box"/>
                      </div>
                      <div id="data" name="data">
                      </div>
                    </div>
                  </div> '
              ;             
            }
          ?>
          <!--teacher end-->

         

        </div><!--container closed-->
      </div>
    </div>
  </body>
</html>
