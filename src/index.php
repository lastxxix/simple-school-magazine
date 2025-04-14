<?php if(!isset($_SESSION)) {session_start();}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
    <title>Giornalino</title>
</head>
<body>

    <?php include('./components/navbar.php');?>
    <?php include('./components/searchbar.php'); ?>
    <?php 
        include_once "./config/dbreader.php";
    
        if(isset($_GET['search']) ){
            if($_GET['search'] == "")
                header("location: ./");
            $query = "SELECT * FROM posts 
            JOIN users ON author = uid 
            JOIN categories ON category = catId 
            WHERE validator IS NOT NULL 
            AND postId IN (SELECT DISTINCT postId FROM posts JOIN users ON author = uid JOIN categories ON category = catId JOIN posthotwords on post = postId JOIN hotwords on posthotwords.hotword = idHotword WHERE validator IS NOT NULL AND hotwords.hotword LIKE '%{$_GET['search']}%') ORDER BY addedAt DESC";
        }
        else if(isset($_GET['cat'])){
            $query = "SELECT * FROM posts 
            JOIN users ON author = uid 
            JOIN categories ON category = catId 
            WHERE validator IS NOT NULL
            AND catName = '{$_GET['cat']}'
            ORDER BY addedAt DESC";
        }
        else{
            $query = "SELECT * FROM posts 
            JOIN users ON author = uid 
            JOIN categories ON category = catId 
            WHERE validator IS NOT NULL
            ORDER BY addedAt DESC";
        }
        
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
                $authorUid = $row['author'];
                $author = $row['name'] . " " . $row['surname'];
                $time = date("M. d, Y", strtotime($row['addedAt']));
                $href = "./article.php?id={$row['postId']}";
                $style = "./styles/card.css";
                include('./components/card.php');
            }
        ?>
        </div>   
    <?php } else { ?>
        <div class="flex-container"><h1>No articles found</h1></div>
    <?php }  ?>
    

    <?php include('./components/footer.php');?>
</body>
</html>