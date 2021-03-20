<?php
    include_once '../dbConnection.php';
    ob_start();

    $name = $_POST['name'];
    $name= ucwords(strtolower($name));
    $name = stripslashes($name);
    $name = addslashes($name);
    $career = $_POST['career'];
    $career = stripslashes($career);
    $career = addslashes($career);
    $email = $_POST['email'];
    $email = stripslashes($email);
    $email = addslashes($email);
    $email = ucwords(strtolower($email));
    $pass = $_POST['password'];
    //$pass = stripslashes($pass);
    //$pass = addslashes($pass);
    //$pass = ucwords(strtolower($pass));;

    $q3=mysqli_query($con,"INSERT INTO career_chief VALUES ('$email','$pass','$name','$career')");

    if($q3){
        header("location:dash_admin.php?q=1&q7=Registro Exitoso!");
    }
    else{
        header("location:dash_admin.php?q=1&q7=El usuario ya ha sido registrada!");   
    }
    ob_end_flush();
?>