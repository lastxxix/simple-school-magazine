<?php if(!isset($_SESSION)) {session_start();}?>
<nav class="navbar">
    <ul class="navbar-items">
        <div class="items">
            <li><a href="./" class="home_link">  <span>HOME</span> <!--<img src="./images/Home-icon.svg" class="home-icon"> --></a></li>
            <?php 
                //Includo i pulsanti in base ai permessi dell' utente loggato
                if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1){
                    include('./components/adminnav.php');
                    include('./components/validatornav.php');
                    include('./components/writernav.php');
                } else if(isset($_SESSION['isValidator']) && $_SESSION['isValidator'] == 1){
                    include('./components/validatornav.php');
                    include('./components/writernav.php');
                }
                else if(isset($_SESSION['isWriter']) && $_SESSION['isWriter'] == 1){
                    include('./components/writernav.php');
                }
            ?>
        </div>

        <div class="login-signup">
            <?php
                //Se loggato mostro solo il bottone logout
                if(isset($_SESSION['isLogged'])){ ?>
                <li class="user-info">
                    <span> <a href="user.php?id=<?php echo $_SESSION['uid'] ?>"><?php echo $_SESSION['name'] . " " .$_SESSION['surname'] ?></a></span>
                    <img src="<?php echo $_SESSION['avatarPath']?>" class="user-avatar" alt="user-logo">
                    <a href="./components/logout.php" class="logout">
                        <img src="./images/logout.png" class="logout-icon">
                    </a> 
                </li>
            <!--  Se l' utente non è loggato  gli mostro i pulsanti di login e registrazione -->
            <?php } else { ?>
                <li>
                    <a href="./login.php" class="login">
                       LOGIN 
                       <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 21v-2h7V5h-7V3h7q.825 0 1.413.587Q21 4.175 21 5v14q0 .825-.587 1.413Q19.825 21 19 21Zm-2-4l-1.375-1.45l2.55-2.55H3v-2h8.175l-2.55-2.55L10 7l5 5Z"/></svg> -->
                    </a>
                </li>
                <li>
                    <a href="./signup.php" class="signup">
                        SIGN UP
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4Z"/></svg> -->
                    </a>
                </li>
            
            <?php } ?>
        </div>
    </ul>

    
    
</nav>

