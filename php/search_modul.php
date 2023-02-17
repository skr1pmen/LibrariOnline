<?php
    require '../php/connect.php';
    $link = get_connect();

    $authors = mysqli_query($link, 'select * from `authors`');
    $authors = mysqli_fetch_all($authors, MYSQLI_ASSOC);