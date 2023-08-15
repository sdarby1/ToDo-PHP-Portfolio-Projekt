<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/header-and-footer.css">
    <link rel="stylesheet" href="/styles/dashboard.css"> 
    <link rel="stylesheet" href="/styles/form.css">
    <link rel="stylesheet" href="/styles/post.css">
    <link rel="stylesheet" href="/styles/home.css">
    <link rel="stylesheet" href="/styles/menu.css">
    <link rel="stylesheet" href="/styles/contact.css">
    <script type="text/javascript" src="/scripts/navbar.js" defer></script>
    <title>CuCasa <?php echo $title ?? '' ?></title>
</head>
<body>
    <header>
        <a href="index.html"><img class="logo" src="/style-images/Logo/logo.png" alt=""></a>
        <nav nav id="header-nav" class="header-nav">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/menu">Speisekarte</a></li>
                <li><a href="/posts">Blog</a></li>
                <li><a href="/contact">Kontakt</a></li>
                <?php if ($user->isLoggedIn()): ?>
                    <li><a href="/post/create">Post erstellen</a></li>
                    <li><a href="/dashboard">Meine Posts</a></li>
                    <li><a class="logout-btn" href="/logout">Ausloggen</a></li>
                <?php else: ?>
                    <li><a href="/login">Einloggen</a></li>
                    <li><a href="/register">Registrieren</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div id="hamburger-menu">
            <div class="bar1 allBars"></div>
            <div class="bar2 allBars"></div>
            <div class="bar3 allBars"></div>
        </div>
    </header>

    <?php if ($session::exists('success')): ?>
        <div class="message success"><?= $session::flash('success') ?></div>
    <?php endif; ?>

    <?php if ($session::exists('error')): ?>
        <div class="message error"><?= $session::flash('error') ?></div>
    <?php endif; ?>
