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
    <script type="text/javascript" src="/scripts/navbar.js" defer></script>
    <title>CuCasa <?php echo $title ?? '' ?></title>
</head>
<body>
    <header>
        <nav nav id="header-nav" class="header-nav">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/menu">Speisekarte</a></li>
                <?php if ($user->isLoggedIn()): ?>
                    <li><a href="/post/create">Post erstellen</a></li>
                    <li><a href="/logout">Ausloggen</a></li>
                    <li><a href="/dashboard">Dashboard</a></li>
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
