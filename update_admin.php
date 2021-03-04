<?php
  include_once 'dbConnection.php';
  session_start();
  $email=$_SESSION['email'];

  //delete feedback
  if(isset($_SESSION['key'])){
    if(@$_GET['fdid'] && $_SESSION['key']=='sunny7785068889') {
      $id=@$_GET['fdid'];
      $result = mysqli_query($con,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
      header("location:dash.php?q=3");
    }
  }

  //delete teacher
  if(isset($_SESSION['key'])){
    if(@$_GET['demploynumber'] && $_SESSION['key']=='sunny7785068889') {
      $demploynumber=@$_GET['demploynumber'];
      $result = mysqli_query($con,"SELECT * FROM quiz WHERE employnumber='$demploynumber' ") or die('Error');
      while($row = mysqli_fetch_array($result)) {
        $eid=$row['eid'];
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
      }

      $result = mysqli_query($con,"DELETE FROM teacher WHERE employnumber='$demploynumber' ") or die('Error 3');
      header("location:dash.php?q=1");
    }
  }
?>



