<?php
    session_start();
    require 'connect.php';
    $link = get_connect();

    $rent_id = $_POST['rent'];
    $edit_id = $_POST['edit'];
    $del_id = $_POST['del'];
    $date = date('Y-m-d');

    var_dump($rent_id, $edit_id, $del_id);

    if(!empty($rent_id)){
        $rent = mysqli_query($link, "insert into `rental` (book_id, user_id, date_start)
values ('{$rent_id}', '{$_SESSION['user']['id']}', '{$date}')");
        header('Location: ../pages/profile.php');
    }elseif(!empty($edit_id)){
        header("Location: ../pages/edit_book.php?id={$edit_id}");
    }elseif(!empty($del_id)){
        mysqli_query($link, "delete from `rental` where book_id = '{$del_id}'");
        mysqli_query($link, "delete from `books` where id = '{$del_id}'");
        header("Location: ../pages/book.php");
    }
