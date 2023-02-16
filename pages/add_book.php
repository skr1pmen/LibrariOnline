<?php
    session_start();
    if(empty($_SESSION['user'])){
        echo '<h1 style="font-family: Jost, sans-serif; width: max-content; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)">Ты кто и откуда?</h1>';
        exit();
    }
    require '../php/connect.php';
    $link = get_connect();

    $authors = mysqli_query($link, 'select * from `authors`');
    $authors = mysqli_fetch_all($authors, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru-ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление книги | Library Online</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?= require './header.php' ?>
    <div class="book_block">
        <h1 class="title">Adding books</h1>
        <span class="error"><?php echo $_SESSION['message']; unset($_SESSION['message']);?></span>
        <form action="../php/add_book.php" method="post" enctype="multipart/form-data">
            <label class="label_text" for="book_name">Введите название книги:</label>
            <input id="book_name" name="book_name" type="text" placeholder="Название книги" required>

            <label class="label_text" for="article">Введите артикул книги:</label>
            <input id="article" name="article" type="text" placeholder="Артикул книги" required>

            <label class="label_text" for="desc">Введите описание книги:</label>
            <textarea style="width: 760px; height: 180px; resize: none" rows="6" maxlength="550" id="desc" name="desc" placeholder="Описание книги (максимум 550 символов)" required></textarea>

            <label class="label_text" for="cover">Выберете обложку книги:</label>
            <input id="cover" name="cover" type="file" required>

            <label class="label_text" for="author">Введите автора:<br>(если нет в списке написать полное ФИО)</label>
            <input id="author" name="author" list="authors" type="text" placeholder="Автор" required>
            <input class="btn" style="width: 280px" type="submit" value="Добавить книгу">
            <br>
        </form>
        <datalist id="authors">
            <?php foreach ($authors as $author) {
                echo "<option value='{$author['fio']}'/>";
            }?>
        </datalist>
    </div>

</body>
</html>