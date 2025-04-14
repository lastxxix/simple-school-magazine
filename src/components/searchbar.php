<!-- Barra di ricerca e mostra le categorie -->
<?php if(!isset($_SESSION)) {session_start();}?>
<div class="search_bar">
    <form action="" method="get">
        <div class="search">
            <button type="submit"><img src="./images/search-icon.png" class="search-icon"></button>
            <input type="text" placeholder="Search..." name="search" id="searchInput">
        </div>
    </form>

    <div class="categories">
        <span>Category: </span>
        <!-- Se ho una categoria selezionata gli aggiunge la classe in modo da colorarla diversamente -->
        <a class="cat_link <?php echo !isset($_GET['cat']) ? 'cat_active' : ''; ?>" href=".">All</a>
        <?php
            //Seleziono tutte le categorie
            include_once "./config/dbreader.php";
            $query = "SELECT * FROM categories";
            $result = $conn->query($query);

            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){ ?>
                <a class="cat_link <?php echo isset($_GET['cat']) && $_GET['cat'] == $row['catName'] ? 'cat_active' : ''; ?>" href="?cat=<?php echo $row['catName'] ?>"><?php echo $row['catName'] ?></a>
        <?php  } ?>
        
    </div>
</div>