<?php
    session_start();
    require 'connect.php';

    $login = $_POST['login'];
    $password = md5($_POST['password']);

    $link = get_connect();
    $login = mysqli_real_escape_string($link, $login);
    $password = mysqli_real_escape_string($link, $password);

    $check_user = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '{$login}' AND `password` = '{$password}'");

    if (mysqli_num_rows($check_user) > 0){
        $user = mysqli_fetch_assoc($check_user);
        $_SESSION['user'] = [
            "id" => $user['id'],
            "name" => $user['name'],
            "surname" => $user['surname'],
            "patronymic" => $user['patronymic'],
            "login" => $user['login'],
            "avatar" => $user['avatar']
        ];
        header('Location: ../index.php');
    }else{
        $_SESSION['message'] = "Неверный логин или пароль!";
        header('Location: ../pages/login.php');
    }
    get_close($link);