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
    <title>Авторизация</title>
</head>
<body>
    <h2 class="title">Авторизация</h2>
    <form action="../php/signin.php" method="post" class="login">
        <label class="label_text" for="login">Введите логин</label><input name="login" id="login" type="text" placeholder="Введите логин" required>
        <label for="password" class="label_text">Введите пароль</label><input name="password" id="password" type="password" placeholder="Введите пароль" required>
        <span class="error"><?php echo $_SESSION['message']; unset($_SESSION['message']);  ?>
        <input class="input_btn" type="submit" value="Авторизоваться">
    </form>
    <span class="form_text">Нет аккаунта? <a href="reg.php">Зарегистрируй</a>!</span>
</body>
</html>
