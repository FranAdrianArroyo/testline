<?php
    include_once '../dbConnection.php';
    $ref=@$_GET['q'];
    $email = $_POST['uname'];
    $password = $_POST['password'];

    $name = stripslashes($name);
    $name = addslashes($name);
    $career = stripslashes($career);
    $career = addslashes($career);
    $email = stripslashes($email);
    $email = addslashes($email);
    $password = stripslashes($password); 
    $password = addslashes($password);
    $result = mysqli_query($con,"SELECT email FROM admin WHERE email = '$email' and password = '$password'") or die('Error');
    $count=mysqli_num_rows($result);

    if($count==1){
        session_start();
        if(isset($_SESSION['email'])){
            session_unset();
        }
        $_SESSION["name"] = 'Jefe de';
        $_SESSION["key"] ='sunny7785068889';
        $_SESSION["email"] = $email;
        header("location:dash_career-chief.php?q=0");
    }
    else header("location:$ref?w=Acceso denegado");
?>