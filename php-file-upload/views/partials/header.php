<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/header-and-footer.css">
    <link rel="stylesheet" href="/styles/form.css">
    <script type="text/javascript" src="/scripts/navbar.js" defer></script>
    <title>Titel</title>
</head>
<body>
<header>
        <a href="index.php"><img class="logo" src="/images/logo.svg"></a>
        <h1 class="doc-title">Title</h1>
        <nav id="header-nav" class="header-nav">
        <?php
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

        if (isset($_SESSION['user_id'])) {
            $initial = strtoupper(substr($_SESSION['username'], 0, 1));
            echo '<a class="profile-picture-btn" href="account.php"><div class="profile-circle"><span>' . $initial . '</span></div></a>';
        }
        
        ?>
            <ul>
                <li> <a class="refresh" href="/home">Home</a></li>
                <li> <a class="refresh" href="/login">Einloggen</a></li>
                <li> <a class="refresh" href="/register">Registrieren</a></li>
                <li> <a class="refresh" href="/post/create">Posts</a></li>
            </ul>
        </nav>

        <div id="hamburger-menu">
            <div class="bar1 allBars"></div>
            <div class="bar2 allBars"></div>
            <div class="bar3 allBars"></div>
        </div>
    </header>
