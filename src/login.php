<?php 
    if(!isset($_SESSION)) {session_start();}
    if(isset($_SESSION['isLogged'])){
        header("location: ./");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="./styles/signup.css">
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
    <title>Login</title>
</head>
<body>
    <?php 
        include('./components/navbar.php');
    ?>
    <div class="container">
      
        <form action="handlers/loginHandler.php" method="post" class="signup-form">
            <h2>Log In</h2>
            <?php if(isset($_GET['e']) && $_GET['e'] != ""){ 
                    if($_GET['e'] == 1) echo "<small class='error'>This email isn't registered, sign up!</small>";
                    if($_GET['e'] == 2) echo "<small class='error'>Wrong email or password!</small>";
                
                }
            ?>
            <div class="email">
                <input type="email" autocapitalize="false" autocomplete="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="password">
                <input type="password" name="pwd" id="pwd" placeholder="Password" required>
            </div>
            <button type="submit">SIGN IN</button>
            <div class="notMember" >
                <a href="signup.php">Not a member? <span>Sign up</span>!</a>
            </div>
        </form>
    </div>
    
    <?php 
        include('./components/footer.php');
    ?>
</body>
</html>