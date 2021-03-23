<?php
  include_once '../dbConnection.php';
  session_start();
  $user=$_SESSION['user'];

  //delete 
  if(isset($_SESSION['key'])){
    if(@$_GET['dname'] && $_SESSION['key']=='sunny1234567890') {
      $dname=@$_GET['dname'];
      $result = mysqli_query($con,"DELETE FROM career_chief WHERE name='$dname'") or die('Error 3');
      header("location:dash_admin.php?q=1");
    }
  }
?>



