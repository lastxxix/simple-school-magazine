<?php if(!isset($_SESSION)) {session_start();}?>
<!-- Footer -->
<footer>
    <span> &copy; Davide Cossidente 5CIA - <?php echo date("l d F Y");?></span>
</footer>

<!-- Chiudo connessioni aperte -->
<?php if(isset($conn) && is_resource($conn) && get_resource_type($conn)==='mysql link') mysqli_close($conn);
?>