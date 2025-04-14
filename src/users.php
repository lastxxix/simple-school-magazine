<?php if(!isset($_SESSION)) {session_start();}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="./styles/users.css">
    <title>Users List</title>
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
</head>
<body>

    <?php 
        include('./components/navbar.php');
        if(!isset($_SESSION)) session_start();
        if(!isset($_SESSION['isLogged']))
            header("location: ./login.php");
        if($_SESSION['isAdmin'] == 1){ 
            include_once "./config/dbmanager.php";
            $query = "SELECT * FROM users JOIN accounts ON account = email WHERE isAdmin = 0 ORDER BY email";
            $results = $conn->query($query);
    ?>
   

    
    <?php if($results->num_rows != 0){  ?>
        <div class="table-container">
            <table>
                <tr>
                    <th>Email</th>
                    <th>Validator</th>
                    <th>Writer</th>
                    <th></th>
                </tr>
            <?php while($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ ?>
                <tr>
                    <form action="./handlers/updatePermissions.php?email=<?php echo $row['email'] ?>" method="POST">
                        <td><?php echo $row['email'] ?></td>
                        <td><input type="checkbox" <?php echo $row['isValidator'] == 1 ? "checked" :  ""; ?> name="isValidator" id="isValidator"> </td>
                        <td><input type="checkbox" <?php echo $row['isWriter'] == 1 ? "checked" :  ""; ?> name="isWriter" id="isWriter"> </td>
                        <td><button type="submit">Save</button></td>
                    </form>
                </tr>
            <?php } ?>
            </table>
        </div>
    <?php } else { ?>
        <div class="container"><h1>NO USERS REGISTERED</h1></div>
    <?php } ?>
    <?php 
        }else{
            header("location: ./");
        } 
    ?>
    <?php include('./components/footer.php'); ?>
</body>
</html>