<?php
    include_once 'dbConnection.php';
    ob_start();

    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $name= ucwords(strtolower($name));
    $gender = $_POST['gender'];
    $schoolnumber = $_POST['schoolnumber'];
    $career = $_POST['career'];
    $groupnum = $_POST['groupnum'];
    $name = stripslashes($name);
    $name = addslashes($name);
    $name = ucwords(strtolower($name));
    $last_name = stripslashes($last_name);
    $last_name = addslashes($last_name);
    $last_name = ucwords(strtolower($last_name));
    $gender = stripslashes($gender);
    $gender = addslashes($gender);
    $schoolnumber = stripslashes($schoolnumber);
    $schoolnumber = addslashes($schoolnumber);
    $career = stripslashes($career);
    $career = addslashes($career);
    $groupnum = stripslashes($groupnum);
    $groupnum = addslashes($groupnum);
    $password = md5($schoolnumber);

    $q3=mysqli_query($con,"INSERT INTO user VALUES  ('$name' , '$last_name', '$gender' , '$career','$schoolnumber' ,'$groupnum', '$password')");

    if($q3){
        header("location:dash_teacher.php?q=1&q7=El usuario se ha registrado!");
    }
    else{
        header("location:dash_teacher.php?q=1&q7=La matricula ya ha sido registrada!");   
    }
    ob_end_flush();
?>