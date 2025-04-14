<?php if(!isset($_SESSION)) {session_start();}?>
<!-- Pagina di errore, se passato un valore 'error' questo viene mostrato -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/global.css">
    <title>Error</title>
    <style>
        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="column">
            <!-- Se non passo un valore 'error' mostro di default la scritta DATABASE ERROR -->
            <h1><?php echo isset($_GET['error']) ? $_GET['error'] : "DATABASE ERROR" ?></h1>
            <h1>CLICK <a href="../">HERE</a> TO RETURN TO HOMEPAGE</h1>
        </div>
    </div>
</body>
</html>