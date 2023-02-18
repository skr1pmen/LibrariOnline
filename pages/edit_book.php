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

    $book_id = $_GET['id'];
    $book = mysqli_query($link, "select * from `books` where id = '{$book_id}'");
    $book = mysqli_fetch_assoc($book);

    $author = mysqli_query($link, "select fio from `authors` where id = '{$book['author_id']}'");
    $author = mysqli_fetch_assoc($author);

    $name = $book['book_name'];
    $article = $book['article'];
    $author_n = $author['fio'];
    $desc = $book['description'];

    get_close($link);
?>

<!DOCTYPE html>
<html lang="ru-ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование книги | Library Online</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php include './header.php' ?>
<div class="container edit_block">
    <h1>Изменение книги</h1>
    <div>
        <form action="../php/edit_book.php?id=<?php echo $book_id?>" method="post" enctype="multipart/form-data">
            <label class="label_text" for="book_name">Введите название книги:</label>
            <input id="book_name" name="book_name" type="text" value="<?php echo $name?>" placeholder="Название книги" required>

            <label class="label_text" for="article">Введите артикул книги:</label>
            <input id="article" name="article" type="text" value="<?php echo $article?>" placeholder="Артикул книги" required>

            <label class="label_text" for="desc">Введите описание книги:</label>
            <textarea style="width: 760px; height: 180px; resize: none" rows="6" maxlength="550" id="desc" name="desc" placeholder="Описание книги (максимум 550 символов)" required><?php echo $desc?></textarea>

            <input class="btn" style="width: 280px" type="submit" value="Изменить книгу">
            <br>
        </form>
        <datalist id="authors">
            <?php foreach ($authors as $author) {
                echo "<option value='{$author['fio']}'/>";
            }?>
        </datalist>
    </div>
</div>
</body>
</html>