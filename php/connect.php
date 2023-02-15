<?php

const HOST = 'localhost';
const USERNAME = 'root';
const PASSWORD = '';
const DATABASE = 'library_php';

function get_connect(){
    $link = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if(!$link){
        die('Давай по новой Серёжа, всё хуйня!');
    }
    return $link;
}
function get_close($link){
    return mysqli_close($link);
}