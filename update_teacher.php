<?php
  include_once 'dbConnection.php';
  session_start();
  $employnumber=$_SESSION['employnumber'];

  //change password
  if(@$_GET['q']== 'pass'){
    $actpass = $_POST['actpass'];
    $actpass = md5($actpass);
    $newpass = $_POST['newpass'];
    $newpasscon = $_POST['cnewpass'];
    $empnum=@$_GET['employnumber'];

    $q=mysqli_query($con,"SELECT * FROM teacher WHERE employnumber='$empnum' " );

    while($row=mysqli_fetch_array($q) ){
      $pass=$row['password'];
    }

    if($actpass !== $pass){
      header("location:dash_teacher.php?q=7&q8=La contraseña actual no concuerda");
    }
    else{
      if($newpass !== $newpasscon){
        header("location:dash_teacher.php?q=7&q8=Las contraseñas nuevas no coinciden");
      }
      else{
        $newpass = md5($newpass);
        $qpass=mysqli_query($con,"UPDATE `teacher` SET `password`= '$newpass' WHERE  employnumber = '$empnum'")or die('Error123');
        header("location:dash_teacher.php?q=7&q8=Se cambió la contraseña");
      }
    }
  }

  //delete feedback
  if(isset($_SESSION['key'])){
    if(@$_GET['fdid'] && $_SESSION['key']=='sunny7785068889') {
      $id=@$_GET['fdid'];
      $result = mysqli_query($con,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
      header("location:dash.php?q=3");
    }
  }

  //delete student
  if(isset($_SESSION['key'])){
    if(@$_GET['dschoolnumber'] && $_SESSION['key']=='tesiteach') {
      $dschoolnumber=@$_GET['dschoolnumber'];
      $r1 = mysqli_query($con,"DELETE FROM rank WHERE schoolnumber='$dschoolnumber' ") or die('Error 1');
      $r2 = mysqli_query($con,"DELETE FROM qualification WHERE schoolnumber='$dschoolnumber' ") or die('Error 2');
      $result = mysqli_query($con,"DELETE FROM user WHERE schoolnumber='$dschoolnumber' ") or die('Error 3');
      header("location:dash_teacher.php?q=1");
    }
  }

  //remove quiz
  if(isset($_SESSION['key'])){
    if(@$_GET['q']== 'rmquiz' && $_SESSION['key']=='tesiteach') {
      $eid=@$_GET['eid'];
      $result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
      while($row = mysqli_fetch_array($result)) {
        $qid = $row['qid'];
        $im = $row['image'];
        unlink("qimage/$im");
        $r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error');
        $r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
      }
      $r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
      $r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
      $r4 = mysqli_query($con,"DELETE FROM qualification WHERE eid='$eid' ") or die('Error');
      $r5 = mysqli_query($con,"DELETE FROM results WHERE eid='$eid' ") or die('Error');
      header("location:dash_teacher.php?q=5");
    }
  }

  //add quiz
  if(isset($_SESSION['key'])){
    if(@$_GET['q']== 'addquiz' && $_SESSION['key']=='tesiteach') {
      $emnum = $_POST['emnum'];
      $subject = $_POST['subject'];
      $name = $_POST['name'];
      $name= ucwords(strtolower($name));
      $grnum= $_POST['groupnumber'];
      $total = $_POST['total'];
      $startDate = $_POST['dateStart'];
      $sdExplode = explode("T", $startDate);
      $sdBase = $sdExplode[0]." ".$sdExplode[1];
      $finalDate = $_POST['dateEnd'];
      $fdExplode = explode("T", $finalDate);
      $fdBase = $fdExplode[0]." ".$fdExplode[1];
      $time = $_POST['time'];
      $desc = $_POST['desc'];
      $id=uniqid();
      $q3=mysqli_query($con,"INSERT INTO quiz VALUES  ('$id', '$emnum', '$subject', '$name' , '$grnum', '$total','$time' ,'$desc', NOW(), '$sdBase', '$fdBase')") or die('Error');
      header("location:dash_teacher.php?q=4&step=2&eid=$id&n=$total");
    }
  }

  //add question
  if(isset($_SESSION['key'])){
    if(@$_GET['q']== 'addqns' && $_SESSION['key']=='tesiteach') {
      $n=@$_GET['n'];
      $eid=@$_GET['eid'];
      $ch=@$_GET['ch'];

      for($i=1;$i<=$n;$i++){
        $qid=uniqid();
        $qns=$_POST['qns'.$i];
        $qval=$_POST['val'.$i];
        $qtopic=$_POST['topic'.$i];
        $qsubtopic=$_POST['subtopic'.$i];
        $qobjective=$_POST['objective'.$i];
        $qcompetence=$_POST['competence'.$i];
        
        $qimage = $_FILES['im'.$i]['name'];
        
        if (isset($qimage) && $qimage != "") {

          $qimagename = uniqid();
          
          $type = $_FILES['im'.$i]['type'];
          $size = $_FILES['im'.$i]['size'];
          $temp = $_FILES['im'.$i]['tmp_name'];
          $ext = explode("/", $type);
          $qimgnew = $qimagename.".".$ext[1];
          //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
          if (!((strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")) && ($size < 2000000))) {
            echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
            - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
          }
          else {
            //Si la imagen es correcta en tamaño y tipo
            //Se intenta subir al servidor
            if (move_uploaded_file($temp, 'qimage/'.$qimgnew)) {
              //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
              chmod('qimage/'.$qimgnew, 0777);
            }
            else {
              //Si no se ha podido subir la imagen, mostramos un mensaje de error
              echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
            }
          }
        }
        else{
          $qimgnew = "no image";
        }

        $q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qval','$qtopic','$qsubtopic','$qobjective','$qcompetence','$qns','$qimgnew','$ch' ,'$i')");
        $oaid=uniqid();
        $obid=uniqid();
        $ocid=uniqid();
        $odid=uniqid();
        $openid=uniqid();
        $tid=uniqid();
        $fid=uniqid();
        $a=$_POST[$i.'1'];
        $b=$_POST[$i.'2'];
        $c=$_POST[$i.'3'];
        $d=$_POST[$i.'4'];
        $op=$_POST[$i.'openans'];
        $tf=$_POST['tfans'.$i];
        $cl=$_POST['ans'.$i];
        $op=strtolower($op);

        if(empty($op) && empty($tf)){
          $qa=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','closed','$a','$oaid')") or die('Error61');
          $qb=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','closed','$b','$obid')") or die('Error62');
          $qc=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','closed','$c','$ocid')") or die('Error63');
          $qd=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','closed','$d','$odid')") or die('Error64');
          $e=$_POST['ans'.$i];
          switch($e){
            case 'a': $ansid=$oaid;
            break;
            case 'b': $ansid=$obid;
            break;
            case 'c': $ansid=$ocid;
            break;
            case 'd': $ansid=$odid;
            break;
            default: $ansid=$oaid;
          }
          $qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");
        }        
        else if(empty($cl) && empty($tf)){
          $qopen=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','opened','$op','$openid')") or die('Error65');
          $ansid=$openid;
          $qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");
        }        
        else if(empty($op) && empty($cl)){
          $qt=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','trfl','Verdadero','$tid')") or die('Error66');
          $qf=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','trfl','Falso','$fid')") or die('Error67');
          switch($tf){
            case 'tr': $ansid = $tid;
            break;
            case 'fal': $ansid = $fid;
            break;
            default: $ansid=$tid;
          }
          $qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");
        }
      }
      header("location:dash_teacher.php?q=0");
    }
  }

?>



