<?php

session_start();

    $pageTitle = 'To Do'; 
    include_once __DIR__  . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'path.php';
    include_once convertToUnixPath(__DIR__ . '/templates/header-and-footer/header.php');



if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {

    header('Location: login-form.php');
    exit();
}



var_dump($_SESSION);

?>

<div class="todo-list-container">

    <div class="user-container">
        
    </div>

    <div class="tasks-container">
        <div class="open-tasks-container">

        </div>

        <div class="checked-tasks-container">

        </div>
    </div>

</div>
