<?php
    session_start();
?>
<header>
    <div class="container">
        <a href="../index.php" class="logo head"><span class="logo_text">Library Online</span></a>
        <nav>
            <a class="head btn" href="../index.php">Home</a>
            <a class="head btn" href="./book.php">Books</a>
            <a class="head btn" href="./authors.php">Authors</a>
        </nav>
        <form action="./php/search.php" method="post" class="search">
            <input list="search" type="search" placeholder="Поисковая строка">
            <input type="submit" value="Поиск">
        </form>
        <datalist id="search">
            <?php foreach ($authors as $author) {
                echo "<option value='{$author['fio']}'/>";
            }?>
        </datalist>
        <?php
            if(empty($_SESSION['user'])){
                echo '<a class="head last_btn" href="./login.php"><i class="fas fa-sign-in-alt"></i></a>';
            } else{
                ?>
                <a class="head last_btn" href="./profile.php"><img class="ava_head" src="data:image/jpeg;base64, <?php echo base64_encode($_SESSION['user']['avatar']) ?>" alt="avatar"></a>
                <?php
            }
        ?>
    </div>
</header>
<style>
    .ava_head{
        width: 48px;
    }
</style>