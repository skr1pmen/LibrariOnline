<?php
    session_start();
    require '../php/connect.php';
    $link = get_connect();

    $authors = mysqli_query($link, 'select * from `authors`');
    $authors = mysqli_fetch_all($authors, MYSQLI_ASSOC);

    $book = mysqli_query($link, "select * from `books` where id = '{$_GET['id']}'");
    $book = mysqli_fetch_assoc($book);

    $author = mysqli_query($link, "select fio from `authors` where id = '{$book['author_id']}'");
    $author = mysqli_fetch_assoc($author);

    $cover = $book['cover'];
    $name = $book['book_name'];
    $author = $author['fio'];
?>
<!doctype html>
<html lang="ru-ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль | Library Online</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?= require './header.php' ?>
    <div class="container">
        <div class="view">
            <img src="data:image/jpeg;base64, <?php echo base64_encode($cover) ?>" alt="">
            <div class="book_info">
                <h2><?php echo $name ?></h2>
                <h3><?php echo $author ?></h3>
                <span>Описание</span>
                <span>Дата добавления</span>
                <a>Имя пользователя</a>
                <div class="buttons">
                    <button type="submit">Арендовать</button>
                    <button type="submit">Редактировать</button>
                    <button type="submit">Удалить</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
