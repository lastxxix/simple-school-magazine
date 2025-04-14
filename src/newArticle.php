<?php 
     if(!isset($_SESSION)) {session_start();}
    if(!isset($_SESSION['isLogged'])){
        header("location: ./login.php");
    }else if($_SESSION['isWriter'] == 0 && $_SESSION['isValidator'] == 0 && $_SESSION['isAdmin'] == 0){
        header("location: ./");
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
    <title>New Post</title>
</head>
<body>
    <?php 
        include('./components/navbar.php');
        include_once "config/dbreader.php";
        $query = "SELECT * FROM categories";
        $results = $conn->query($query);
    ?>

    <form action="./handlers/newArticleHandler.php" method="post" class="newArticleForm" enctype="multipart/form-data">
        
        <div class="image_cat">
            <div class="title">
                <span>Title</span>
                <input type="text" placeholder="Title" name="title" id="title" required>
            </div>
            <div class="new_article_img">
                <span>Image</span>
                <input type="file" accept=".jpg, .png, .jpeg" name="article_img" id="new_article_img">
            </div>
            
            <div class="category">
                <span>Category</span>
                <select name="category" id="category">
                    <option name="" id="" disabled>Choose a category</option>
                    <?php while($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ ?>
                        <option value="<?php echo $row['catId'] ?>"><?php echo $row['catName'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        
        <div class="summary">
            <span>Summary</span>
            <textarea name="summary" maxlength="255" placeholder="Summary" id="summary" required cols="30" rows="10"></textarea>
        </div>
        <div class="article_body">
            <span>Text</span>
            <textarea name="article_body" placeholder="Text" id="article_body" required cols="30" rows="10"></textarea>
        </div>
        <div class="hotwords">
            <span>Hotwords (space separated)</span>
            <textarea name="hotwords" id="hotwords" placeholder="Hotwords (space separated)" required cols="30" rows="10"></textarea>
        </div>
       
        
        <div class="sendform">
            <button type="submit">INSERT</button>
        </div>
        
    </form>
    <?php include('./components/footer.php');?>
</body>
</html>