<?php 
    session_start();
    if(isset($_SESSION['user'])) {
        session_destroy();
    }
    $ref= @$_GET['q'];
    header("location:$ref");
?>