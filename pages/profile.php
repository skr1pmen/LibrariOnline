<?php
    session_start();
    if(empty($_SESSION['user'])){
        echo '<h1 style="font-family: Jost, sans-serif; width: max-content; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)">Ты кто и откуда?</h1>';
        exit();
    }
?>

<!DOCTYPE html>
<html lang="ru-ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль | Library Online</title>
    <link rel="stylesheet" href="../styles/style.css">
    <?php
        if($_SESSION['mc'] === true){
            echo '<link rel="stylesheet" href="../styles/mc.css">';
        }else{
            echo '<link rel="stylesheet" href="../styles/fonts.css">';
        }
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <div class="container">
            <a href="../index.php" class="logo head"><span class="logo_text">Library Online</span></a>
            <nav>
                <a class="head btn" href="#">Home</a>
                <a class="head btn" href="#">Books</a>
                <a class="head btn" href="#">Authors</a>
            </nav>
            <a class="head last_btn" href="#"><img class="ava_head" src="data:image/jpeg;base64, <?php echo base64_encode($_SESSION['user']['avatar']) ?>" alt="avatar"></a>
        </div>
    </header>
    <span class="OK"><?php echo $_SESSION['message']; unset($_SESSION['message'])?></span>
    <div class="content container">
        <div class="photo">
            <img class="ava" src="data:image/jpeg;base64, <?php echo base64_encode($_SESSION['user']['avatar']) ?>" alt="avatar">
            <a href="./profile_edit.php">edit information ✏</a>
            <form action="../php/exit.php" method="post">
                <button class="btn btn_exit" type="submit">exit account</button>
            </form>
        </div>
        <div class="info__books">
            <h3 class="fio"><?= $_SESSION['user']['name'] ?> <?= $_SESSION['user']['surname'] ?> <?= $_SESSION['user']['patronymic'] ?></h3>
            <div class="books">
                <span>No books added</span>
            </div>
        </div>
    </div>
    <style>
        .ava_head{
            width: 48px;
        }
        .ava{
            width: 250px;
        }
    </style>
</body>
</html>