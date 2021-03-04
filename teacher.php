<?php
    include_once 'dbConnection.php';
    $ref=@$_GET['q'];
    $employnumber = $_POST['employnumber'];
    $password = $_POST['password'];

    $employnumber = stripslashes($employnumber);
    $employnumber = addslashes($employnumber);
    $password = stripslashes($password); 
    $password = addslashes($password);
    $password=md5($password); 

    $result = mysqli_query($con,"SELECT * FROM teacher WHERE employnumber = '$employnumber' and password = '$password'") or die('Error en la consulta');
    $count=mysqli_num_rows($result);

    if($count==1){        

        while($row = mysqli_fetch_array($result)) {
			$name = $row['name'];
		}
        session_start();
        if(isset($_SESSION['employnumber'])){
            session_unset();
        }
        $_SESSION["name"] = $name;
        $_SESSION["key"] ='tesiteach';
        $_SESSION["employnumber"] = $employnumber;
        header("location:dash_teacher.php?q=0");
    }

    else{
        $check = mysqli_query($con,"SELECT * FROM teacher WHERE employnumber = '$employnumber'");
        while($row = mysqli_fetch_array($check)) {
			$empnumb = $row['employnumber'];
        }
        $count2=mysqli_num_rows($check);
        if($count2==0){
            header("location:$ref?w=El usuario no ha sido registrado. Pida su registro con el administrador");
        }
        else{
            $pwd = $row['password'];
            if(strcmp($password, $pwd) !== 0){
                header("location:$ref?w=Error en la contraseña");
            }
        }
    }
?>