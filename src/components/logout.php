<?php if(!isset($_SESSION)) {session_start();}?>
<?php
    session_destroy();
    unset($_SESSION);
    header("location: ../");
?>