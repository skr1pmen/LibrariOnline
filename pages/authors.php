<?php
    session_start();
    require '../php/connect.php';
    $link = get_connect();
    $check_authors = mysqli_query($link, "select * from `authors`");
    $authors = mysqli_fetch_all($check_authors,MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="ru-ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Список авторов | Library Online</title>
</head>
<body>
    <?= require './header.php' ?>
    <div class="container">
        <div style="border: none; margin-top: 0;" class="books">
            <div class="authors">
                <table>
                    <tr><th>Номер автора</th><th>Фамилия имя отчество</th></tr>
                    <?php
                        if(mysqli_num_rows($check_authors) === 0){
                            echo "<span>На сайте ещё нет авторов</span>";
                        }else{
                            foreach ($authors as $author){?>
                                <tr><td><?php echo $author['id']?></td><td><?php echo $author['fio']?></td></tr>
                                <?php
                            }
                        }
                        ?>
                </table>
            </div>
        </div>
    </div>
    <style>
        table{
            width: max-content;
            margin: 0 auto;
        }
    </style>
</body>
</html>
<?php get_close($link);?>