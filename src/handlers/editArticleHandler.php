<?php 
    if(!isset($_SESSION)) {session_start();}
    //Se non è presente una sessione lo rimando alla pagina di login
    if(!isset($_SESSION))
        header("location: ../login.php");
    //Controllo che sia almeno scrittore
    if($_SESSION['isAdmin'] == 1 || $_SESSION['isValidator'] == 1 || $_SESSION['isWriter'] == 1){
        include_once '../config/dbwriter.php';
        //Se non invio dati col post, lo rimando alla home
        if(!isset($_POST))
            header("location: ../");
        //Se non invio dati con la chiave 'id', lo rimando alla home
        if(!isset($_GET['id']))
            header("location: ../");
        //Filtro per prendere la variabile dell' articolo da modificare
        $postId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        //Seleziono il post dato l' id
        $query = "SELECT * FROM posts WHERE postId = '$postId'";
        $result = $conn->query($query);
        //Se non esiste un articolo lo rimando alla home
        if(mysqli_num_rows($result) == 0)
            header("location: ../");
        $result = mysqli_fetch_assoc($result);
        //Se l'utente che cerca di modificare è diverso dall' autore lo rimando alla home
        if($result['author'] != $_SESSION['uid'])
            header("location: ../");
            
        //Filtro i dati ricevuti in input    
        $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
        $summary = filter_var($_POST['summary'], FILTER_SANITIZE_SPECIAL_CHARS);
        $text = filter_var($_POST['article_body'], FILTER_SANITIZE_SPECIAL_CHARS);
        $category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
        $hotwords = explode(" ", $_POST['hotwords']);
       
        //  ini_set('display_errors',1);
        // error_reporting(E_ALL);
        //Aggiorno l'articolo
        $query = "UPDATE posts SET title='$title', summary='$summary', text='$text', category='$category' WHERE postId = $postId";
        $conn->query($query);
        //Elimino le hotword vecchie
        $query = "DELETE FROM posthotwords WHERE post = $postId";
        $conn->query($query);
        //Se sono presenti le sostituisco con le nuove
        if(!empty($hotwords)){
            for($i = 0; $i < count($hotwords); $i++){
                $hotword = strtolower($hotwords[$i]);
                if(!empty($hotword)){
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
                    $query = "INSERT INTO posthotwords (hotword, post) VALUES ('$hotwordId', '$postId')";
                    $conn->query($query);
                }
               
            }
        }
        //Lo rimando alla pagina con gli  articoli creati da lui
        header("location: ../user.php?id={$_SESSION['uid']}");
    }else{
        //Lo rimando alla home se non è almeno uno scrittore
        header("location: ../");
    }
?>