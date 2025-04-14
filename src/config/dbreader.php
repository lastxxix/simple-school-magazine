<?php

    //Connessione da lettore, può solo selezionare dalle varie tabelle.

    $dbHost=getenv('DB_HOST');
    $dbUsr=getenv('DB_USER');
    $dbPass=getenv('DB_PASS');
    $dbName=getenv('DB_NAME');
   
    $conn=new mysqli($dbHost,$dbUsr,$dbPass,$dbName);

    if($conn->connect_error){
        header("location: ../components/error.php");
    }
        