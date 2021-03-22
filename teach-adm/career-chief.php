<?php
    include_once '../dbConnection.php';
    $ref=@$_GET['q'];
    $email = $_POST['uname'];
    $password = $_POST['password'];

    $email = stripslashes($email);
    $email = addslashes($email);
    $password = stripslashes($password); 
    $password = addslashes($password);
    $result = mysqli_query($con,"SELECT * FROM career_chief WHERE email = '$email' and password = '$password'") or die('Error');
    $count=mysqli_num_rows($result);

    if($count==1){
        while($row = mysqli_fetch_array($result)) {
            $name = $row['name'];
            $career = $row['career'];
        }
        session_start();
        if(isset($_SESSION['email'])){
            session_unset();
        }
        $_SESSION["name"] = $name;
        $_SESSION["key"] ='sunny7785068889';
        $_SESSION["email"] = $email;
        $_SESSION["career"] = $career;
        header("location:dash_career-chief.php?q=0");
    }
    else header("location:$ref?w=Acceso denegado");
?>