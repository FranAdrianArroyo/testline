<?php 
    session_start();
    if(isset($_SESSION['schoolnumber'])){
        session_destroy();
    }
    $ref= @$_GET['q'];
    header("location:$ref");
?>