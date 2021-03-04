<?php 
    session_start();
    if(isset($_SESSION['employnumber'])){
        session_destroy();
    }
    $ref= @$_GET['q'];
    header("location:$ref");
?>