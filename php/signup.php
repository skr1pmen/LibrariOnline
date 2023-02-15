<?php
    session_start();
    require 'connect.php';

//    Объявление переменных с привязкой к элементам формы
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $patronymic = $_POST['patronymic'];
    $ava = $_FILES['ava']['tmp_name'];
    $login = $_POST['login'];
    $password = md5($_POST['password']);


//    Подключение к БД & "перевод" переменных в удобный формат для MqSQLi
    $link = get_connect();
    $name = mysqli_real_escape_string($link, $name);
    $surname = mysqli_real_escape_string($link, $surname);
    $patronymic = mysqli_real_escape_string($link, $patronymic);
    $login = mysqli_real_escape_string($link, $login);
    $password = mysqli_real_escape_string($link, $password);

    $ava = addslashes(file_get_contents($ava));

//    Проверна на существующего пользователя и регистрация или переадресация назад
    $user = mysqli_query($link,"SELECT * FROM `users` where login = '{$login}'");
    $user = mysqli_fetch_all($user, MYSQLI_ASSOC);
    if (empty($user)){
        $result = get_connect()->query("INSERT INTO users (name, surname, patronymic, login, password, avatar)
        VALUES ('{$name}', '{$surname}', '{$patronymic}', '{$login}', '{$password}', '{$ava}')");
        header('Location: ../pages/login.php');
    }
    else{
        $_SESSION['message'] = 'Логин занят!';
        header('Location: ../pages/reg.php');
    }
    get_close($link);
