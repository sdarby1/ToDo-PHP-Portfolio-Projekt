<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once __DIR__ . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'path.php';
include_once convertToUnixPath(__DIR__ . '/includes/connect-db.php');
require_once convertToUnixPath(__DIR__ . '/includes/errors.php');
require_once convertToUnixPath(__DIR__ . '/includes/register.php');


$userRegistration = new UserRegistration($db);
$errors = [];

$query = "SELECT * FROM user";
$statement = $db->query($query);
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($userRegistration->register($errors)) {
        
        header('Location: login-form.php?success=1');
        exit();
    }
}

include_once convertToUnixPath(__DIR__ . '/templates/register-form.php');

include_once convertToUnixPath(__DIR__ . '/templates/header-and-footer/footer.php');
