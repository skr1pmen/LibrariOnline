<?php
    session_start();
    require 'connect.php';
    $old_password = md5($_POST['old_password']);
    $new_password = md5($_POST['new_password']);
    $id = $_SESSION['user']['id'];

    $link = get_connect();
    $old_password = mysqli_real_escape_string($link, $old_password);
    $new_password = mysqli_real_escape_string($link, $new_password);

    $password = mysqli_query($link, "select password from `users` where id = '{$id}'");

    if($old_password != $password){
        $_SESSION['message'] = "Пароли не совпадают!";
    }elseif($old_password === $new_password){
        $_SESSION['message'] = "Новый и старый пароль одинаковые!";
    }else{
        $result = mysqli_query($link, "update `users` set password = '{$new_password}' where id = '{$id}'");
        $_SESSION['message'] = "Пароль успешно изменён!";
    }