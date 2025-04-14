<?php
    if(!isset($_SESSION)) {session_start();}

    if(isset($_SESSION['isLogged'])){
       
        if($_SESSION['isAdmin'] == 1){
            include_once '../config/dbmanager.php';
            if(!isset($_POST) && !isset($_GET['email']))
                header("location: ../users.php");
            $email = $_GET['email'];
            $isValidator = $_POST['isValidator'] == 'on' ? 1 : 0;
            $isWriter = $_POST['isWriter'] == 'on' ? 1 : 0;
            ini_set('display_errors',1);
            error_reporting(E_ALL);
            $query = "UPDATE accounts SET isWriter = '{$isWriter}', isValidator = '{$isValidator}' WHERE email = '{$email}'";
            $conn->query($query);
            
            header("location: ../users.php");
        }else{
            header("location: ../");
        }
    }else{
        header("location: ../login.php");
    }

    
?>