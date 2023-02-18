<?php
    session_start();
    if(empty($_SESSION['user'])){
        echo '<h1 style="font-family: Jost, sans-serif; width: max-content; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)">Ты кто и откуда?</h1>';
        exit();
    }
    require '../php/connect.php';
    $link = get_connect();

    $check_books = mysqli_query($link, "select * from `books` where user_add = '{$_SESSION['user']['id']}' order by data_add desc");
    $books = mysqli_fetch_all($check_books,MYSQLI_ASSOC);

    $rent_book = mysqli_query($link, "select * from `rental` where user_id = '{$_SESSION['user']['id']}' order by date_start");
    $rent = mysqli_fetch_all($rent_book, MYSQLI_ASSOC);

    $authors = mysqli_query($link, 'select * from `authors`');
    $authors = mysqli_fetch_all($authors, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
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
    <span class="OK"><?php echo $_SESSION['message']; unset($_SESSION['message'])?></span>
    <div class="content container">
        <div class="photo">
            <img class="ava" src="data:image/jpeg;base64, <?php echo base64_encode($_SESSION['user']['avatar']) ?>" alt="avatar">
            <a href="./profile_edit.php">edit information ✏</a>
            <form action="../php/exit.php" method="post">
                <button class="btn btn_exit" type="submit">exit account</button>
            </form>
        </div>
        <div style="width: 600px" class="info__books">
            <h3 class="fio"><?= $_SESSION['user']['name'] ?> <?= $_SESSION['user']['surname'] ?> <?= $_SESSION['user']['patronymic'] ?></h3>
            <div style="border: none; margin-top: 0" class="books">

                <h1>Арендованные книги</h1>
                <div class="add_books">
                    <?php
                        if(mysqli_num_rows($rent_book) === 0){
                            echo "<span>Нет книг взятых в аренду</span>";
                        }else{
                            foreach ($rent as $id){
                                $user_books = mysqli_query($link, "select * from `books` where id = '{$id['book_id']}'");
                                $user_books = mysqli_fetch_all($user_books, MYSQLI_ASSOC);
                                foreach ($user_books as $user_book){?>
                                    <div class="book">
                                        <img style="width: 150px; height: 225px;" src="data:image/jpeg;base64, <?php echo base64_encode($user_book['cover']) ?>" alt="">
                                        <h3 class="book_name"><?php echo $user_book['book_name']?></h3>
                                        <span class="date" style="margin-bottom: 10px"><?php echo date('Y-m-d')-$id['date_start']?></span>
                                        <a href="./book_view.php?id=<?php echo $user_book['id'] ?>" style="padding: 5px 25px" class="btn">Подробнее</a>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="books">
                <h1>Добавленные книги</h1>
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
                                    <a href="./book_view.php?id=<?php echo $book['id'] ?>" style="padding: 5px 25px" class="btn">Подробнее</a>
                                </div>
                        <?php

                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <style>
        .ava{
            width: 250px;
        }
    </style>
</body>
</html>
<?php get_close($link);?>