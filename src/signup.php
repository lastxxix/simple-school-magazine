<?php 
     if(!isset($_SESSION)) {session_start();}
    if(isset($_SESSION['isLogged'])){
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
    <link rel="stylesheet" href="./styles/signup.css">
    <title>Sign Up</title>
</head>
<body>
    <?php 
        include('./components/navbar.php');
    ?>
    <div class="container">
        <form action="./handlers/signupHandler.php" method="post" class="signup-form" enctype="multipart/form-data">
            <h2>Sign Up</h2>
            <?php if(isset($_GET['e']) && $_GET['e'] != ""){ 
                    if($_GET['e'] == 1) echo "<small class='error'>This email is already registered, try to login!</small>";
                }
            ?>     
            <div class="name">
                <input type="text" autocomplete="given-name" name="name" id="name" placeholder="Name" required>
            </div>
            <div class="surname">
                <input type="text" autocomplete="family-name" name="surname" id="surname" placeholder="Surname" required>
            </div>
            <div class="email">
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="password">
                <input type="password" name="pwd" id="pwd" placeholder="Password" required>
            </div>
            <div class="avatar">
                <input type="file" accept=".jpg, .png, .jpeg" placeholder="Avatar" name="avatar" id="avatar">
            </div>
            <div class="signup-code">
                <input type="text" name="code" placeholder="Secret code" id="code">
                
            </div>
            <button type="submit">Sign up</button>
            <div class="notMember" >
                <a href="login.php">Already have an account? <span>Sign In</span>!</a>
            </div>
        </form>
    </div>
    <?php 
        include('./components/footer.php');
    ?>
</body>
</html>