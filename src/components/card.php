<?php if(!isset($_SESSION)) {session_start();}?>
<!-- Card utilizzata per mostrare le notizie -->
<link rel="stylesheet" href="<?php echo $style ?>">
<div class="post_container">
    <div class="post_header">
        <img class="post_userImg" src="<?php echo $userImg; ?>">
        <div class="user_date">
            <span id="post_author"><a href="user.php?id=<?php echo $authorUid  ?>"><?php echo $author; ?></a></span>
            <span>•</span>
            <span><?php echo $time; ?></span>
        </div>
    </div>
    <div class="post_body">
        <div class="post_content">
            <span><?php echo $title; ?></span>
            <span class="post_summary"><?php echo $summary; ?></span>
        </div>
        <img src="<?php echo $imgPath; ?>" class="post_img">
    </div>
    <div class="post_footer">
       
        <span class="cat"><?php echo $tag; ?></span>
   
        <a class="post_link" href="<?php echo $href; ?>"> 
            <span>Read more</span> 
            <img src="./images/link.svg" class="href_img"> 
        </a>

        
    </div>
</div>