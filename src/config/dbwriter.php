<?php

    //Connessione da scrittore e validatore, permette di selezionare da tutte le tabelle riguardanti gli articoli
    //ed inoltre permette di modificare la tabella dell' articolo
    $dbHost=getenv('DB_HOST');
    $dbUsr=getenv('DB_USER');
    $dbPass=getenv('DB_PASS');
    $dbName=getenv('DB_NAME');


    $conn=new mysqli($dbHost,$dbUsr,$dbPass,$dbName);

    if($conn->connect_error){
        header("location: ../components/error.php");
    }