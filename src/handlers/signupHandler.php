<?php

    if(!isset($_SESSION)) {session_start();}
    $target_dir = "./uploads/";
    $target_file = $target_dir . time() . basename($_FILES["avatar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
    if(!isset($_SESSION['isLogged'])){
        //Codice  segreto per diventare amministartori
        $code = "$2y$10$6TLXNdvHjrEOIBaEYCc/N.toCko46uSY3/RSFK45dci50R99/aucq";
        include_once '../config/dbmanager.php';
        if(isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['name']) && isset($_POST['surname'])){
            //Controllo  la validitià della mail
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['email'];
            }else{
                //Se mail non valida lo rimando a registrazione
                header("location: ../signup.php");
            }
            $query = "SELECT * FROM accounts WHERE email = '{$email}'";
            $results = $conn->query($query);
            $isAdmin = 0;
            if(mysqli_num_rows($results) == 0){
                if(isset($_POST['code']) && password_verify($_POST['code'], $code)){
                    $isAdmin = 1;
                }
                if(empty($_FILES['avatar']["tmp_name"]))
                    $uploadOk = 0;
                else{
                    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
                    if($check !== false) {
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
                            $uploadOk = 0;
                        }
                    }
                } 
                if(!move_uploaded_file($_FILES["avatar"]["tmp_name"], "." . $target_file)){
                    $uploadOk = 0;
                }
                if($uploadOk == 0){
                    $target_file = "./images/avatar.png";
                }

                $encPassword = password_hash($_POST['pwd'], PASSWORD_BCRYPT);
                $query = "INSERT INTO accounts (email, pwd, isAdmin, isValidator, isWriter) VALUES ('{$email}', '{$encPassword}',$isAdmin, 0, 0)";
                $conn->query($query);
                $query = "INSERT INTO users (name, surname, account, avatarPath) VALUES ('{$_POST['name']}', '{$_POST['surname']}', '{$email}', '{$target_file}')";
                $conn->query($query);
                
                header("location: ../login.php");
            }else{
                header("location: ../signup.php?e=1");
            }
        }
        else{
            header("location: ../components/error.php");
        }
    }

    
?>