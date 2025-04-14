<?php
    include_once "./config/dbreader.php";
    if(!isset($_SESSION)) {session_start();}
    if(!isset($_GET['id'])) header("location: ./");
    $query = "SELECT * FROM users WHERE uid = {$_GET['id']}";
    $author = $conn->query($query);
    if(mysqli_num_rows($author) == 0) header("location: ./");
    $author = mysqli_fetch_assoc($author);

    $authorFullname = $author['name'] . " " . $author['surname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/global.css">
    <title><?php echo $authorFullname ?> </title>
</head>
<body>
    <?php include('./components/navbar.php');?>
    <?php 
        
        if(isset($_SESSION['uid']) && $_SESSION['uid'] == $_GET['id']){
            $query = "SELECT * FROM posts 
            JOIN users ON author = uid 
            JOIN categories ON category = catId 
            AND uid = '{$_GET['id']}'
            ORDER BY addedAt DESC";
        }else{
            $query = "SELECT * FROM posts 
            JOIN users ON author = uid 
            JOIN categories ON category = catId 
            WHERE validator IS NOT NULL
            AND uid = '{$_GET['id']}'
            ORDER BY addedAt DESC";
        }
        
       

        $posts = $conn->query($query);
    ?>
    <?php if(mysqli_num_rows($posts) != 0){  ?>
        <div class="flex-container">
        <h1><?php echo $authorFullname?>'s posts</h1>
        <?php 
            while($row=mysqli_fetch_array($posts,MYSQLI_ASSOC)){
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