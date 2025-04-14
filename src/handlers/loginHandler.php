<?php

    if(!isset($_SESSION)) {session_start();}
    //Controllo che sia loggato
    if(!isset($_SESSION['isLogged'])){
        include_once '../config/dbmanager.php';
        //Controllo che sia inviata la mail
        if(isset($_POST['email']) && isset($_POST['pwd'])){
            //Controllo  la validitià della mail
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['email'];
            }else{
                //Se mail non valida lo rimando a login
                header("location: ../login.php?e=2");
            }
            
            $query = "SELECT * FROM users JOIN accounts ON email = account WHERE email = '{$email}'";
            $results = $conn->query($query);
            if(mysqli_num_rows($results) == 1){
                $row = mysqli_fetch_assoc($results);
                if(password_verify($_POST['pwd'], $row['pwd'])){
                    $_SESSION['isLogged'] = 1;
                    $_SESSION['isAdmin'] = $row['isAdmin'];
                    $_SESSION['isWriter'] = $row['isWriter'];
                    $_SESSION['isValidator'] = $row['isValidator'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['pwd'] = $row['pwd'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['surname'] = $row['surname'];
                    $_SESSION['uid'] = $row['uid'];
                    $_SESSION['avatarPath'] = $row['avatarPath'];
                    header("location: ../");
                }else{
                    header("location: ../login.php?e=2");
                }  
            }else{
                header("location: ../login.php?e=1");
            }
        }else{
            header("location: ../components/error.php");
        }
    }

    
?>