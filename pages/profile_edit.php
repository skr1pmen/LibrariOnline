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
    <title>Изменение данных | Library Online</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include './header.php' ?>
    <div class="container edit_block">
        <h1>Settings</h1>
        <div>
            <h3>User data</h3>
            <h3>Password</h3>
            <form class="edit" action="../php/user_edit.php" method="post" enctype="multipart/form-data">
                <label for="name">Имя: </label><input id="name" name="name" type="text" value="<?php echo $_SESSION['user']['name'] ?>" placeholder="Ваше имя" required>
                <label for="surname">Фамилия: </label><input id="surname" name="surname" type="text" value="<?php echo $_SESSION['user']['surname'] ?>" placeholder="Ваша фамилия" required>
                <label for="patronymic">Отчество: </label><input id="patronymic" name="patronymic" type="text" value="<?php echo $_SESSION['user']['patronymic'] ?>" placeholder="Ваше отчество" required>

                <label for="ava">Аватарка: </label><input id="ava" name="ava" type="file">

                <input class="input_btn"  type="submit" value="Изменить">
            </form>
            <form class="edit" action="../php/repeat_password.php" method="post">
                <label for="old_password">Старый пароль: </label><input id="old_password" name="old_password" type="text" placeholder="Введите старый пароль" readonly>
                <label for="new_password">Старый пароль: </label><input id="new_password" name="new_password" type="text" placeholder="Введите новый пароль" required>
                <span class="error"><?php echo $_SESSION['message']; unset($_SESSION['message'])?></span>
                <input class="input_btn"  type="submit" value="Изменить пароль">
            </form>
        </div>
    </div>
</body>
</html>