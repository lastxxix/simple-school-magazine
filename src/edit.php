<?php 
    if(!isset($_SESSION)) {session_start();}
    if(!isset($_SESSION['isLogged'])){
        header("location: ./login.php");
    }
    else if(($_SESSION['isWriter'] == 0 && $_SESSION['isValidator'] == 0 && $_SESSION['isAdmin'] == 0) || !isset($_GET['id'])){
        header("location: ./");
    }else{
        include_once "config/dbreader.php";
        $postId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM posts WHERE postId = $postId and validator IS NULL";
        $result = $conn->query($query);
        if(mysqli_num_rows($result) == 0)
            header("location: ./");
        $result = mysqli_fetch_assoc($result);
        if($result['author'] != $_SESSION['uid'])
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
    <title>Edit </title>
</head>
<body>
    <?php 
        include('./components/navbar.php');
        $query = "SELECT * FROM categories";
        $categories = $conn->query($query);
    ?>

    <form action="./handlers/editArticleHandler.php?id=<?php echo $postId ?>" method="post" class="newArticleForm" enctype="multipart/form-data">
        
        <div class="image_cat">
            <div class="title">
                <span>Title</span>
                <input type="text" value="<?php echo $result['title'] ?>" placeholder="Title" name="title" id="title" required>
            </div>
      
            
            <div class="category">
                <span>Category</span>
                <select name="category" id="category" required>
                    <option disabled>Choose a category</option>
                    <?php while($category=mysqli_fetch_array($categories,MYSQLI_ASSOC)){ ?>
                        <option <?php echo $result['category'] == $category['catId'] ? "selected='selected'" : ""; ?>  value="<?php echo $category['catId'] ?>"><?php echo $category['catName'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        
        <div class="summary">
            <span>Summary</span>
            <textarea name="summary" maxlength="255" placeholder="Summary" id="summary" required cols="30" rows="10"><?php echo $result['summary'] ?></textarea>
        </div>
        <div class="article_body">
            <span>Text</span>
            <textarea name="article_body" placeholder="Text" id="article_body" required cols="30" rows="10"><?php echo $result['text'] ?></textarea>
        </div>
        <div class="hotwords">
            <span>Hotwords (space separated)</span>
            <?php  
                $query = "SELECT * FROM posthotwords JOIN posts ON post = postId JOIN hotwords on posthotwords.hotword = idHotword WHERE postId = $postId";
                $hotwordsList = $conn->query($query);
            ?>  
            <textarea name="hotwords" id="hotwords" placeholder="Hotwords (space separated)" required cols="30" rows="10"><?php  while($row=mysqli_fetch_array($hotwordsList,MYSQLI_ASSOC)) echo "{$row['hotword']} "; ?></textarea>
        </div>
       
        
        <div class="sendform">
            <button type="submit">CONFIRM CHANGES</button>
        </div>
        
    </form>
    <?php include('./components/footer.php');?>
</body>
</html>