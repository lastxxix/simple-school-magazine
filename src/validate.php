<?php 
    if(!isset($_SESSION)) {session_start();}

    if(!isset($_SESSION['isLogged']))
        header("location: ./login.php");
    if(!isset($_SESSION) || ($_SESSION['isValidator'] != 1  && $_SESSION['isAdmin'] != 1)){
        header("location: ./");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/global.css">
    <title>Post to validate</title>
</head>
<body>
    <?php 
        include('./components/navbar.php');
    ?>

    <?php 
        include_once "config/dbreader.php";
        $query = "SELECT * FROM posts 
        JOIN users ON author = uid 
        JOIN categories ON category = catId 
        WHERE validator IS NULL
        ORDER BY addedAt DESC";
       
        $results = $conn->query($query);

    ?>
    <?php if(mysqli_num_rows($results) != 0){  ?>
        <div class="flex-container">
    
        <?php 
            while($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){
                $title = $row['title'];
                $userImg = $row['avatarPath'];
                $imgPath = $row['imagePath'];
                $tag = $row['catName'];
                $summary = $row['summary'];
                $author = $row['name'] . " " . $row['surname'];
                $authorUid = $row['author'];
                $time = date("d.m.Y", strtotime($row['addedAt']));
                $href = "./article.php?id={$row['postId']}";
                $style = "./styles/card.css";
                include('./components/card.php');
            }
        ?>
        </div>
    <?php } else{ ?>
        <div class="flex-container"><h1>No articles to validate</h1></div>
    <?php  }?>
    
    <?php 
        include('./components/footer.php');
    ?>
</body>
</html>