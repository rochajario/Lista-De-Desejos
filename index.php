<?php
    require 'vendor/autoload.php';
    session_start();
    
    if(!$_SESSION['usuario']){
        header('Location: router.php');
    }

    if($_SESSION['usuario']){
        header('Location: produtos.php');
    }
?>