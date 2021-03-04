<?php
    include_once 'dbConnection.php';
    ob_start();

    $name = $_POST['name'];
    $name= ucwords(strtolower($name));
    $employnumber = $_POST['employnumber'];
    $name = stripslashes($name);
    $name = addslashes($name);
    $name = ucwords(strtolower($name));
    $password = md5($employnumber);

    $q3=mysqli_query($con,"INSERT INTO teacher VALUES  ('$employnumber' , '$name' , '$password')");

    if($q3){
        header("location:dash.php?q=1&q7=El usuario se ha registrado!");
    }
    else{
        header("location:dash.php?q=1&q7=La matricula ya ha sido registrada!");   
    }
    ob_end_flush();
?>