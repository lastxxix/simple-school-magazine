<?php 
    if(!isset($_SESSION)) {session_start();}

    $target_dir = "./uploads/";
    $target_file = $target_dir . time() . basename($_FILES["article_img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(!isset($_SESSION))
        header("location: ../login.php");
    if($_SESSION['isAdmin'] == 1 || $_SESSION['isValidator'] == 1 || $_SESSION['isWriter'] == 1){
        include_once '../config/dbwriter.php';
        if(!isset($_POST))
            header("location: ../newArticle.php");
        $date = date("Y-m-d");
        $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
        $summary = filter_var($_POST['summary'], FILTER_SANITIZE_SPECIAL_CHARS);
        $text = filter_var($_POST['article_body'], FILTER_SANITIZE_SPECIAL_CHARS);
        $hotwords = explode(" ", $_POST['hotwords']);
       

        if(empty($_FILES['article_img']["tmp_name"]))
            $uploadOk = 0;
        else{
            $check = getimagesize($_FILES["article_img"]["tmp_name"]);
            if($check !== false) {
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
                    $uploadOk = 0;
                }
            }
        }
        if(!move_uploaded_file($_FILES["article_img"]["tmp_name"], "." . $target_file)){
            $uploadOk = 0;
        }
        if($uploadOk == 0){
            $target_file = "./images/defaultArticleImage.jpg";
        }
        //  ini_set('display_errors',1);
        // error_reporting(E_ALL);
        $query = "INSERT INTO posts(title, summary, text, imagePath, author, category) values ('$title', '$summary', '$text', '{$target_file}' ,'{$_SESSION['uid']}', '{$_POST['category']}')";
        $conn->query($query);
        $postId = $conn->insert_id;

        if(!empty($hotwords)){
            for($i = 0; $i < count($hotwords); $i++){
                $hotword = strtolower($hotwords[$i]);
                $query = "SELECT idHotword FROM hotwords WHERE hotword = '$hotword'";
                $result = $conn->query($query);
                if(mysqli_num_rows($result) == 1){
                    $row = $result->fetch_assoc();
                    $hotwordId = $row['idHotword'];
                }else{
                    $query = "INSERT INTO hotwords (hotword) VALUES ('$hotword')";
                    $conn->query($query);
                    $hotwordId = $conn->insert_id;
                }
                //echo $hotwordId . " " . $postId;
                $query = "INSERT INTO posthotwords (hotword, post) VALUES ('$hotwordId', '$postId')";
                $conn->query($query);
            }
        }

        header("location: ../user.php?id={$_SESSION['uid']}");
    }else{
        header("location: ../login.php");
    }
?>