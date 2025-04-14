<?php 
    if(!isset($_SESSION)) {session_start();}
    if(isset($_GET['id'])){
        include_once "./config/dbreader.php";
        $query = "SELECT * FROM posts JOIN users ON uid = author WHERE postId = '{$_GET['id']}'";
        $results = $conn->query($query);
        if(mysqli_num_rows($results) > 0){ 
            while($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){
                $title = $row['title'];
                $text = $row['text'];
                $userImg = $row['avatarPath'];
                $imgPath = $row['imagePath'];
                $summary = $row['summary'];
                $author = $row['name'] . " " . $row['surname'];
                $time = date("M. d, Y", strtotime($row['addedAt']));
                $validator = $row['validator'];
                $uid = $row['author'];
            }
        }
        mysqli_close($conn);
    }
    if(isset($_POST['validate']) && is_null($validator)){
        include_once "./config/dbwriter.php";
        $date = date("Y-m-d");
        $query = "UPDATE posts SET validator = {$_SESSION['uid']}, validatedAt = '{$date}' WHERE postId = {$_GET['id']}";
        $conn->query($query);
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
    <title>Post </title>
</head>
<body>
    <?php include('./components/navbar.php');?>

    <div class="article">
        <div class="article_header">
            <h1 class="article_title"><?php echo $title; ?></h1>
            <div class="user_data">
                <div class="first">
                    <img src="<?php echo $userImg ?>" class="article_user">
                    <span><?php echo $author; ?></span>
                </div>
                
                <span class="article_date">Published <?php echo $time ?></span>
            </div>
        </div>
      
        <img src="<?php echo $imgPath ?>" class="article_img">
        <div class="article_content">
            <span><?php echo $text; ?></span>

        </div>
        <div class="hotwords">
            <?php 
                include "./config/dbreader.php";
                $postId = $_GET['id'];
                $query = "SELECT * FROM posthotwords JOIN posts ON post = postId JOIN hotwords on posthotwords.hotword = idHotword WHERE postId = $postId";
                $hotwordsList = $conn->query($query);
                if(mysqli_num_rows($hotwordsList) != 0){
                    while($row=mysqli_fetch_array($hotwordsList,MYSQLI_ASSOC)){
                        echo "<span class='hotword'>#{$row['hotword']} </span>";
                    }
                }
                mysqli_close($conn);
            ?>
        </div>
        <div class="edit_validate">
            <?php if(is_null($validator) && !isset($_POST['validate']) && isset($_SESSION) && $_SESSION['uid'] == $uid) { ?>
                <button id="edit"><a href="edit.php?id=<?php echo $postId ?>">Edit post</a></button>
            <?php } ?>
            <?php if(is_null($validator) && !isset($_POST['validate']) && (isset($_SESSION) && ($_SESSION['isValidator'] == 1 || $_SESSION['isAdmin'] == 1) )) { ?>
        
                <form action="" method="post" class="validate_footer">
                    <button type="submit" id="validate" name="validate">Validate post</button>
                </form>
            <?php  } ?>
        </div>
        
    </div>
    


    



    <?php include('./components/footer.php');?>
</body>
</html>