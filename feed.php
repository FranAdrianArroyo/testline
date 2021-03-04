<?php
    include_once 'dbConnection.php';
    $ref=@$_GET['q'];
    $name = $_POST['name'];
    $schoolnumber = $_POST['schoolnumber'];
    $subject = $_POST['subject'];
    $id=uniqid();
    $date=date("Y-m-d");
    $time=date("h:i:sa");
    $feedback = $_POST['feedback'];
    $q=mysqli_query($con,"INSERT INTO feedback VALUES  ('$id' , '$name', '$schoolnumber' , '$subject', '$feedback' , '$date' , '$time')")or die ("Error");
    header("location:account.php?q=4");
?>