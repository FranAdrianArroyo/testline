<?php

  include_once 'dbConnection.php';
  session_start();
  $schoolnumber=$_SESSION['schoolnumber'];

  //change password
  if(@$_GET['q']== 'pass'){
    $actpass = $_POST['actpass'];
    $actpass = md5($actpass);
    $newpass = $_POST['newpass'];
    $newpasscon = $_POST['cnewpass'];
    $schnum=@$_GET['schoolnumber'];

    $q=mysqli_query($con,"SELECT * FROM user WHERE schoolnumber='$schnum' " );

    while($row=mysqli_fetch_array($q) ){
      $pass=$row['password'];
    }

    if($actpass !== $pass){
      header("location:account.php?q=6&q7=La contraseña actual no concuerda");
    }
    else{
      if($newpass !== $newpasscon){
        header("location:account.php?q=6&q7=Las contraseñas nuevas no coinciden");
      }
      else{
        $newpass = md5($newpass);
        $qpass=mysqli_query($con,"UPDATE `user` SET `password`= '$newpass' WHERE  schoolnumber = '$schnum'")or die('Error123');
        header("location:account.php?q=6&q7=Se cambió la contraseña");
      }
    }
  }

  //change mail
  if(@$_GET['q']== 'mail'){
    $usermail = $_POST['usermail'];
    $schnum=@$_GET['schoolnumber'];

    $qmail=mysqli_query($con,"UPDATE `user` SET `email`= '$usermail' WHERE  schoolnumber = '$schnum'")or die('Error123');
    header("location:account.php?q=4&q7=Dirección de correo electrónico guardada");     
    
  }

  //save answers
  if(@$_GET['q']== 'answer'){
    $eid=@$_GET['eid'];
    $qid=@$_GET['qid'];
    $sn=@$_GET['n'];
    $total=@$_GET['t'];
    $scn=@$_GET['scn'];

    $button = $_POST['question'];
    $left_time = $_POST['time'];

    if($button == 'SIGUIENTE'){
      $useransid = $_POST['ans'.$sn];
      $sn++;
      $q=mysqli_query($con,"SELECT * FROM results WHERE eid='$eid' AND qid='$qid' AND schoolnumber ='$scn'" );
      $rowcount = mysqli_num_rows($q);

      $q1=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );

      while($row=mysqli_fetch_array($q1) ){
        $ansid=$row['ansid'];
      }

      if($rowcount == 0){
        $qinsert=mysqli_query($con,"INSERT INTO results VALUES('$scn', '$eid', '$qid', '$ansid', '$useransid', 'opcion', $left_time)")or die('Error insert');
        $qupdTime=mysqli_query($con,"UPDATE `results` SET `left_time`=$left_time WHERE eid='$eid' AND schoolnumber ='$scn'")or die('Error update');
      }
      else{
        $qupd=mysqli_query($con,"UPDATE `results` SET `studentansid`='$useransid' WHERE qid='$qid' AND schoolnumber ='$scn'")or die('Error update');
        $qupdTime=mysqli_query($con,"UPDATE `results` SET `left_time`=$left_time WHERE eid='$eid' AND schoolnumber ='$scn'")or die('Error update');
      }

      header("location:account.php?q=quiz2&eid=$eid&n=$sn&t=$total"); 
    }

    elseif($button == 'ANTERIOR'){
      $useransid = $_POST['ans'.$sn];
      $sn--;
      $q=mysqli_query($con,"SELECT * FROM results WHERE eid='$eid' AND qid='$qid' AND schoolnumber ='$scn'" );
      $rowcount = mysqli_num_rows($q);

      $q1=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );

      while($row=mysqli_fetch_array($q1) ){
        $ansid=$row['ansid'];
      }

      if($rowcount == 0){
        $qinsert=mysqli_query($con,"INSERT INTO results VALUES('$scn', '$eid', '$qid', '$ansid', '$useransid', 'opcion', '$left_time')")or die('Error insert');
        $qupdTime=mysqli_query($con,"UPDATE `results` SET `left_time`=$left_time WHERE eid='$eid' AND schoolnumber ='$scn'")or die('Error update');
      }
      else{
        $qupd=mysqli_query($con,"UPDATE `results` SET `studentansid`='$useransid' WHERE qid='$qid' AND schoolnumber ='$scn'")or die('Error update');
        $qupdTime=mysqli_query($con,"UPDATE `results` SET `left_time`=$left_time WHERE eid='$eid' AND schoolnumber ='$scn'")or die('Error update');
      }
      header("location:account.php?q=quiz2&eid=$eid&n=$sn&t=$total"); 
    }
    
    if($_POST['finish_btn']){//TERMINAR
      $useransid = $_POST['ans'.$sn];
      $q=mysqli_query($con,"SELECT * FROM results WHERE eid='$eid' AND qid='$qid' AND schoolnumber ='$scn'" );
      $rowcount = mysqli_num_rows($q);

      $q1=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );

      while($row=mysqli_fetch_array($q1) ){
        $ansid=$row['ansid'];
      }

      if($rowcount == 0){
        $qinsert=mysqli_query($con,"INSERT INTO results VALUES('$scn', '$eid', '$qid', '$ansid', '$useransid', 'opcion', '$left_time')")or die('Error insert');
        $qupdTime=mysqli_query($con,"UPDATE `results` SET `left_time`=$left_time WHERE eid='$eid' AND schoolnumber ='$scn'")or die('Error update');
      }
      else{
        $qupd=mysqli_query($con,"UPDATE `results` SET `studentansid`='$useransid' WHERE qid='$qid' AND schoolnumber ='$scn'")or die('Error update');
        $qupdTime=mysqli_query($con,"UPDATE `results` SET `left_time`=$left_time WHERE eid='$eid' AND schoolnumber ='$scn'")or die('Error update');
      }

      $total_score = 0;
      for ($i=1; $i <= $total; $i++) { 
        $q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$i' " );
        while($row=mysqli_fetch_array($q) ){
          $qid=$row['qid'];
          $qval=$row['qval'];
          $total_score=$total_score+$qval;
        }
        $q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );

        while($row=mysqli_fetch_array($q) ){
          $ansid=$row['ansid'];
        }
        $q=mysqli_query($con,"SELECT * FROM results WHERE qid='$qid' AND schoolnumber ='$scn'" );

        while($row=mysqli_fetch_array($q) ){
          $ans=$row['studentansid'];
        }

         if($ans == $ansid){//right
          if($i == 1){
            $qcal=mysqli_query($con,"INSERT INTO qualification VALUES('$eid','$schoolnumber' ,'0','0','0','0','0', '', NOW())")or die('Error ');
          }
          $qcal=mysqli_query($con,"SELECT * FROM qualification WHERE eid='$eid' AND schoolnumber='$schoolnumber' ")or die('Error115');
        
          while($row=mysqli_fetch_array($qcal) ){
            $right_ans=$row['right_ans'];    
            $final_score=$row['final_score']; 
          }
        
          $qcal2=mysqli_query($con,"SELECT * FROM questions WHERE qid='$qid' " );
        
          while($row=mysqli_fetch_array($qcal2) ){
            $qval2=$row['qval'];
            $final_score=$final_score+$qval2;
          }
      
          $qopt=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
          while($row=mysqli_fetch_array($qopt) ){
            $opt=$row['option'];
          }
          
          $right_ans++;    
          $porcen = ($final_score * 100) / $total_score;  
          if($porcen >= 70){
            $qcal=mysqli_query($con,"UPDATE `qualification` SET `total_score`=$total_score,`final_score`=$final_score,`right_ans`=$right_ans,`porcent`=$porcen,`status`='APROBADO' , date= NOW()  WHERE  schoolnumber = '$schoolnumber' AND eid = '$eid'")or die('Error124');
          }
          else{
            $qcal=mysqli_query($con,"UPDATE `qualification` SET `total_score`=$total_score,`final_score`=$final_score,`right_ans`=$right_ans,`porcent`=$porcen,`status`='REPROBADO' , date= NOW()  WHERE  schoolnumber = '$schoolnumber' AND eid = '$eid'")or die('Error124');
          }
          
        } 
        else{//wrong
          if($i == 1){
            $qcal=mysqli_query($con,"INSERT INTO qualification VALUES('$eid','$schoolnumber' ,'0','0','0','0','0', '', NOW())")or die('Error ');
          }
          $qcal=mysqli_query($con,"SELECT * FROM qualification WHERE eid='$eid' AND schoolnumber='$schoolnumber' ")or die('Error115');
          while($row=mysqli_fetch_array($qcal) ){
            $wrong_ans=$row['wrong_ans']; 
            $final_score=$row['final_score']; 
          }
      
          $qopt=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
          while($row=mysqli_fetch_array($qopt) ){
            $opt=$row['option'];
          }
        
          $wrong_ans++;
          $porcen = ($final_score * 100) / $total_score; 
          if($porcen >= 70){
            $qcal=mysqli_query($con,"UPDATE `qualification` SET `total_score`=$total_score,`final_score`=$final_score,`wrong_ans`=$wrong_ans,`porcent`=$porcen,`status`='APROBADO' , date= NOW()  WHERE  schoolnumber = '$schoolnumber' AND eid = '$eid'")or die('Error124');
          }
          else{
            $qcal=mysqli_query($con,"UPDATE `qualification` SET `total_score`=$total_score,`final_score`=$final_score,`wrong_ans`=$wrong_ans,`porcent`=$porcen,`status`='REPROBADO' , date= NOW()  WHERE  schoolnumber = '$schoolnumber' AND eid = '$eid'")or die('Error124');
          }
        }        
      }
      header("location:account.php?q=result&eid=$eid");   
    }
  }

  //restart quiz
  if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) {
    $eid=@$_GET['eid'];
    $n=@$_GET['n'];
    $t=@$_GET['t'];
    $q=mysqli_query($con,"SELECT final_score FROM qualification WHERE eid='$eid' AND schoolnumber='$schoolnumber'" )or die('Error156');
    
    while($row=mysqli_fetch_array($q) ){
      $s=$row['final_score'];
    }

    $q=mysqli_query($con,"DELETE FROM `qualification` WHERE eid='$eid' AND schoolnumber='$schoolnumber' " )or die('Error184');
    $q=mysqli_query($con,"SELECT * FROM rank WHERE schoolnumber='$schoolnumber'" )or die('Error161');

    while($row=mysqli_fetch_array($q) ){
      $sun=$row['score'];
    }

    $sun=$sun-$s;
    $q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE schoolnumber= '$schoolnumber'")or die('Error174');
    header("location:account.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
  }

?>



