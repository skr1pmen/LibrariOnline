<?php
    session_start();
    require 'connect.php';
    $link = get_connect();

    $book_name = $_POST['book_name'];
    $article = $_POST['article'];
    $desc = $_POST['desc'];
    $id = $_GET['id'];

    $book_name = mysqli_real_escape_string($link, $book_name);
    $article = mysqli_real_escape_string($link, $article);
    $desc = mysqli_real_escape_string($link, $desc);

    $edit_book = mysqli_query($link, "update `books` set book_name = '{$book_name}', article = '{$article}', description = '{$desc}' where id = '{$id}'");
    header("Location: ../pages/book_view.php?id=$id");

