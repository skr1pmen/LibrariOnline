<header>
    <div class="container">
        <a href="../index.php" class="logo head"><span class="logo_text">Library Online</span></a>
        <nav>
            <a class="head btn" href="../index.php">Home</a>
            <a class="head btn" href="./book.php">Books</a>
            <a class="head btn" href="#">Authors</a>
        </nav>
        <a class="head last_btn" href="./profile.php"><img class="ava_head" src="data:image/jpeg;base64, <?php echo base64_encode($_SESSION['user']['avatar']) ?>" alt="avatar"></a>
    </div>
</header>
<style>
    .ava_head{
        width: 48px;
    }
</style>