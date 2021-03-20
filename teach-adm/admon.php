<?php
    include_once '../dbConnection.php';
    $ref=@$_GET['q'];
    $user = $_POST['unamead'];
    $password = $_POST['passwordad'];

    $user = stripslashes($user);
    $user = addslashes($user);
    $password = stripslashes($password); 
    $password = addslashes($password);
    $result = mysqli_query($con,"SELECT user FROM admon WHERE user = '$user' and password = '$password'") or die('Error');
    $count=mysqli_num_rows($result);

    if($count==1){
        session_start();
        if(isset($_SESSION['user'])){
            session_unset();
        }
        $_SESSION["user"] = 'ADMINISTRADOR';
        $_SESSION["key"] ='sunny1234567890';
        header("location:dash_admin.php?q=1");
    }
    else header("location:$ref?w=Acceso denegado");
?>