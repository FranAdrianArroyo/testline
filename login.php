<?php
	session_start();
	if(isset($_SESSION["schoolnumber"])){
		session_destroy();
	}
	include_once 'dbConnection.php';
	$ref=@$_GET['q'];
	$schoolnumber = $_POST['schoolnumber'];
	$password = $_POST['password'];

	$schoolnumber = stripslashes($schoolnumber);
	$schoolnumber = addslashes($schoolnumber);
	$password = stripslashes($password); 
	$password = addslashes($password);
	$password=md5($password); 
	$result = mysqli_query($con,"SELECT * FROM user WHERE schoolnumber = '$schoolnumber' and password = '$password'") or die('Error');
	$count=mysqli_num_rows($result);

	if($count==1){
		while($row = mysqli_fetch_array($result)) {
			$name = $row['name'];
			$last_name = $row['last_name'];
			$career = $row['career'];
			$groupnum = $row['groupnum'];
		}
		$_SESSION["name"] = $name;
		$_SESSION["last_name"] = $last_name;
		$_SESSION["schoolnumber"] = $schoolnumber;
		$_SESSION["career"] = $career;
		$_SESSION["groupnum"] = $groupnum;
		$_SESSION["key"] ='student';
		header("location:account.php?q=1");
	}
	else{
		$check = mysqli_query($con,"SELECT * FROM user WHERE schoolnumber = '$schoolnumber'");
        while($row = mysqli_fetch_array($check)) {
			$schnumb = $row['schoolnumber'];
        }
        $count2=mysqli_num_rows($check);
        if($count2==0){
            header("location:$ref?w=El usuario no ha sido registrado. Pida su registro con alguno de sus profesores");
        }
        else{
            $pwd = $row['password'];
            if(strcmp($password, $pwd) !== 0){
                header("location:$ref?w=Error en la contraseña");
            }
        }
	}
		
?>