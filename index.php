<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TestLine | |
      Tecnológico de Estudios Superiores de Ixtapaluca
    </title>

    <link rel="shortcut icon" href="image/logo.png" />
    <link  rel="stylesheet" href="css/bootstrap.min.css"/>
    <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
    <link rel="stylesheet" href="css/main.css">
    <link  rel="stylesheet" href="css/font.css">
    <script src="js/jquery.js" type="text/javascript"></script>

    <script src="js/bootstrap.min.js"  type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

    <?php if(@$_GET['w'])
      {echo'<script>alert("'.@$_GET['w'].'");</script>';}
    ?>
    <?php
        include_once 'dbConnection.php';
        session_start();
        if ((isset($_SESSION['schoolnumber']))) {
          header("location:account.php?q=1");
        }
    ?>    
  </head>

  <body>
    <div class="header">
      <div class="row">
        <div class="col-lg-6">
          <img src="image/h1_tesi.png" style="height: 75px;">
          <span class="logo">TestLine TESI</span>
        </div>
        <div class="col-md-2 col-md-offset-4">
          <a href="#" class="pull-right btn sub1" data-toggle="modal" data-target="#myModal">
            <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;
            <span class="title1">
              <b>Iniciar Sesión</b>
            </span>
          </a>
        </div>

        <!--sign in modal start-->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content title1">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title title1">
                  <span style="color:#879E0F;font-family:'typo'; font-size: 30px;">INICIO DE SESIÓN ALUMNOS</span>
                </h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" action="login.php?q=index.php" method="POST">
                  <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="schoolnumber"></label>  
                      <div class="col-md-6">
                        <label>Ingresa tu matricula:</label>
                        <input id="schoolnumber" name="schoolnumber" placeholder="&#128100;   Ej. 201632879" class="form-control input-md" type="number" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                      </div>
                    </div>
                    <!-- Password input-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="password"></label>
                      <div class="col-md-6">
                        <label>Ingresa tu contraseña:</label>
                        <input id="password" name="password" placeholder="&#128273;   ***********" class="form-control input-md" type="password">
                      </div>
                    </div>
              </div>
              <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">INGRESAR</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
		              </fieldset>
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!--sign in modal closed-->

      </div><!--header row closed-->
    </div>

    
    <div class="bg1">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
          <li data-target="#myCarousel" data-slide-to="4"></li>
          <li data-target="#myCarousel" data-slide-to="5"></li>
          <li data-target="#myCarousel" data-slide-to="6"></li>
          <li data-target="#myCarousel" data-slide-to="7"></li>
          <li data-target="#myCarousel" data-slide-to="8"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="carousel/imagen_1.png" alt="" width="100%" height="100%" style="width:100%;">
          </div>
          <div class="item">
            <img src="carousel/imagen_2.png" alt="" width="100%" height="100%" style="width:100%;">
          </div>
          <div class="item">
            <img src="carousel/imagen_3.png" alt="" width="100%" height="100%" style="width:100%;">
          </div>
          <div class="item">
            <img src="carousel/imagen_4.png" alt="" width="100%" height="100%" style="width:100%;">
          </div>
          <div class="item">
            <img src="carousel/imagen_5.png" alt="" width="100%" height="100%" style="width:100%;">
          </div>
          <div class="item">
            <img src="carousel/imagen_6.png" alt="" width="100%" height="100%" style="width:100%;">
          </div>
          <div class="item">
            <img src="carousel/imagen_7.png" alt="" width="100%" height="100%" style="width:100%;">
          </div>
          <div class="item">
            <img src="carousel/imagen_8.png" alt="" width="100%" height="100%" style="width:100%;">
          </div>
          <div class="item">
            <img src="carousel/imagen_9.png" alt="" width="100%" height="100%" style="width:100%;">
          </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
      </div>
    </div><!--bg1-->

    <!--Footer start-->
    <div class="row footer">
      <div class="col-md-3 box">
        <a href="https://tesi.org.mx/" target="_blank">Página principal del Tecnológico</a>
      </div>
      <div class="col-md-3 box">
        <a href="#" data-toggle="modal" data-target="#VideoTutorial">Video Tutorial</a>
      </div>
      <div class="col-md-3 box">
        <a href="#" data-toggle="modal" data-target="#politicas">Avisos De Privacidad</a>
      </div>
    </div>    

    <!--Modal for video-->
	  <div class="modal fade" id="VideoTutorial">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;
              </span>
              <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title">
              <span style="color:orange;font-family:'typo' ">Tutorial</span>
            </h4>
          </div>
          <div class="modal-body title1">
            <div class="row">
              <div class="col-md-3">
              </div>
              <div class="col-md-6">
                <div class="video">
                </div>
              </div>
              <div class="col-md-3">
              </div>
            </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--Modal for privacy policies-->
    <div class="modal fade" id="politicas">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;
              </span>
              <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title">
              <span style="color:#879E0F;font-family:'typo'; font-size: 20px;">AVISO DE PRIVACIDAD</span>
            </h4>
          </div>
          <div class="modal-body title1">
            <div class="row">
              <div class="col-md-3">
              </div>
              <div class="col-md-12">
                <form>
                  <p style="text-align: justify;">Tus datos estan siendo protegidos por la Ley ARCO, si deseas conocer de manera más detallada esta información consulta los enlaces que a continuación se muestran:</p><br>
                  <a href="documentos/AVISO DE PRIVACIDAD DE LA COMUNIDAD ESTUDIANTIL.pdf">* Aviso de Privacidad General</a><br>
                  <a href="documentos/AVISO DE PRIVACIDAD.pdf">* Aviso de Privacidad de Alumnos Aspirantes a Alumnos, Exalumnos y Egresados</a><br><br>
                  <div class="form-group" align="right">
                    <button type="submit" class="btn btn-primary">ACEPTAR</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                  </div>
                </form>
              </div>
              <div class="col-md-3">
              </div>
            </div>
          </div>
          <!--<div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>-->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!--footer end-->
  </body>
</html>
