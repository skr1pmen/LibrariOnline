<?php
session_start()
?>

<!doctype html>
<html lang="ru-ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/style.css">
    <?php
        if($_SESSION['mc'] === true){
            echo '<link rel="stylesheet" href="../styles/mc.css">';
        }else{
            echo '<link rel="stylesheet" href="../styles/fonts.css">';
        }
    ?>
    <title>Регистрация</title>
</head>
<body>
    <h2 class="title">Регистрация</h2>
    <form action="../php/signup.php" method="post" class="login" enctype="multipart/form-data">
        <label class="label_text" for="name">Введите имя</label><input name="name" id="name" type="text" placeholder="Введите имя" required>
        <label class="label_text" for="surname">Введите фамилию</label><input name="surname" id="surname" type="text" placeholder="Введите фимилию" required>
        <label class="label_text" for="patronymic">Введите отчество</label><input name="patronymic" id="patronymic" type="text" placeholder="Введите отчество">

        <label class="label_text" for="ava">Загрузите аватарку</label><input name="ava" id="ava" type="file" required>

        <label class="label_text" for="login">Введите логин</label><span class="error"><?php echo $_SESSION['message']; unset($_SESSION['message']);  ?></span><input name="login" id="login" type="text" placeholder="Введите логин" required>
        <label for="password" class="label_text">Введите пароль</label><input name="password" id="password" type="password" placeholder="Введите пароль" required>
        <input class="input_btn" type="submit" value="Зарегистрироваться">
    </form>
    <span class="form_text">Есть аккаунт? <a href="login.php">Войди</a>!</span>
</body>
</html>