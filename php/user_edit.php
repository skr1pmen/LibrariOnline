<?php
    session_start();
    require 'connect.php';

//    Перменные из Session
    $id = $_SESSION['user']['id'];
    $name = $_SESSION['user']['name'];
    $surname = $_SESSION['user']['surname'];
    $patronymic = $_SESSION['user']['patronymic'];
    $avatar = $_SESSION['user']['avatar'];
    unset($_SESSION['user']);

//    Объявление перменных полученных из формы
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $patronymic = $_POST['patronymic'];
    $avatar = $_FILES['ava']['tmp_name'];
//    Подключение к БД & "перевод" переменных в удобный формат для MqSQLi
    $link = get_connect();
    $name = mysqli_real_escape_string($link, $name);
    $surname = mysqli_real_escape_string($link, $surname);
    $patronymic = mysqli_real_escape_string($link, $patronymic);

    $avatar = addslashes(file_get_contents($avatar));

    $result = get_connect()->query("UPDATE `users` SET name = '{$name}', surname = '{$surname}', patronymic = '{$patronymic}' WHERE '{$id}'");
    if(!empty($avatar)){
        $result = get_connect()->query("UPDATE `users` SET avatar = '{$avatar}' WHERE '{$id}'");
    }
    $_SESSION['user'] = [
        "id" => $id,
        "name" => $name,
        "surname" => $surname,
        "patronymic" => $patronymic,
        "avatar" => $avatar
    ];
    $_SESSION['message'] = "Данные успешно отредактированны!";
    header('Location: ../pages/profile.php');
    get_close($link);
