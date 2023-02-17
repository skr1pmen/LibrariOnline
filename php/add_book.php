<?php
    session_start();
    require 'connect.php';
    $link = get_connect();

    $id = $_SESSION['user']['id'];
    $book_name = $_POST['book_name'];
    $article = $_POST['article'];
    $desc = $_POST['desc'];
    $author = $_POST['author'];
    $cover = $_FILES['cover']['tmp_name'];

    $book_name = mysqli_real_escape_string($link, $book_name);
    $article = mysqli_real_escape_string($link, $article);
    $desc = mysqli_real_escape_string($link, $desc);
    $author = mysqli_real_escape_string($link, $author);
    $cover = addslashes(file_get_contents($cover));

//    var_dump($book_name,$article,$desc,$author);

    $check_author = mysqli_query($link, "select fio from `authors` where fio = '{$author}'");
    if(mysqli_num_rows($check_author) === 0){
        $add_author = mysqli_query($link, "insert into `authors` (fio) values ('{$author}')");
    }

    $check_book = mysqli_query($link, "select book_name from `books` where book_name = '{$book_name}'");
    $check_article = mysqli_query($link, "select article from `books` where article = '{$article}'");
    $author_id = mysqli_fetch_assoc(mysqli_query($link, "select id from `authors` where fio = '{$author}'"));

    if(mysqli_num_rows($check_book) === 0){
        if(mysqli_num_rows($check_article) === 0){
            $add_book = mysqli_query($link, "insert into `books` (book_name, author_id, article, description, data_add, cover, user_add)
values ('{$book_name}', '{$author_id['id']}', '{$article}', '{$desc}', NOW(), '{$cover}', '{$id}')");
            header('Location: ../pages/book.php');
        }else{
            $_SESSION['message'] = 'Этот артикуль уже используется!';
        }
    }else{
        $_SESSION['message'] = 'Книга с таким названием уже существует!';
    }
    get_close($link);







