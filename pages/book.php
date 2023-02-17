<?php
    session_start();
    require '../php/connect.php';
    $link = get_connect();
    $check_books = mysqli_query($link, "select * from `books` where user_add = '{$_SESSION['user']['id']}' order by book_name");
    $books = mysqli_fetch_all($check_books,MYSQLI_ASSOC);
    get_close($link);
?>

<!doctype html>
<html lang="ru-ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/fonts.css">
    <title>Список книг | Library Online</title>
</head>
<body>
    <?= require './header.php' ?>
    <div class="container">
        <div style="border: none; margin-top: 0;" class="books">
            <a class="btn add_book" href="./add_book.php">Add Book</a>
            <div class="add_books">
                <?php
                if(mysqli_num_rows($check_books) === 0){
                    echo "<span>No books added</span>";
                }else{
                    foreach ($books as $book){?>
                        <div class="book">
                            <img style="width: 150px; height: 225px;" src="data:image/jpeg;base64, <?php echo base64_encode($book['cover']) ?>" alt="">
                            <h3 class="book_name"><?php echo $book['book_name']?></h3>
                            <span class="date" style="margin-bottom: 10px"><?php echo $book['data_add']?></span>
                            <a href="#" style="padding: 5px 25px" class="btn">Подробнее</a>
                        </div>
                        <?php

                    }
                }

                ?>
            </div>
        </div>
    </div>
</body>
</html>
