<?php

session_start();

    $pageTitle = 'Account'; 
    include_once __DIR__  . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'path.php';
    include_once convertToUnixPath(__DIR__ . '/templates/header-and-footer/header.php');



if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {

    header('Location: login-form.php');
    exit();
}

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    echo '<p class="greeting">Willkommen auf deiner Account-Seite ' . $_SESSION['username'] . '!</p>';
}

