<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/header-and-footer.css">
    <link rel="stylesheet" href="/styles/form.css">
    <link rel="stylesheet" href="/styles/post.css">
    <link rel="stylesheet" href="/styles/home.css">
    <link rel="stylesheet" href="/styles/dashboard.css">
    <link rel="stylesheet" href="/styles/fonts.css">
    <script type="text/javascript" src="/scripts/navbar.js" defer></script>
    <title>Titel</title>
</head>
<body>
<header>
        <a href="index.php"><img class="logo" src="/images/logo.svg"></a>

        <nav id="header-nav" class="header-nav">
            <ul>
                <li> <a class="" href="/">Home</a></li>
                <li><a href=""> <?xml version="1.0" encoding="UTF-8"?><svg id="b" xmlns="http://www.w3.org/2000/svg" width="140.69" height="224.84" viewBox="0 0 140.69 224.84"><rect x="104.5" y="60.58" width="14.52" height="164.26" rx="7.26" ry="7.26"/><ellipse cx="111.76" cy="41.07" rx="28.93" ry="41.07"/><g><rect x="20.7" y="67.71" width="14.52" height="157.13" rx="7.26" ry="7.26"/><path d="M56.89,69.11c0,5.27-12.69,9.54-28.35,9.54S.19,74.38,.19,69.11c0-.32,6.88-.5,15.85-.57,16.77-.14,40.85,.11,40.85,.57Z"/><rect x="0" y="0" width="11.47" height="73.36" rx="5.74" ry="5.74"/><rect x="45.87" y="0" width="11.47" height="72.67" rx="5.74" ry="5.74" /><rect x="22.22" y="0" width="11.47" height="72.67" rx="5.74" ry="5.74" /><ellipse cx="28.29" cy="67.66" rx="18.95" ry="4.37" /></g></svg>Speisekarte</a></li>
                <li><a href=""> <?xml version="1.0" encoding="UTF-8"?><svg id="a" xmlns="http://www.w3.org/2000/svg" width="157.28" height="272.63" viewBox="0 0 157.28 272.63"><path d="M154.46,54.39c-6.32-26.55-22.09-37.16-22.09-37.16l2.05,1.62s-57.02-43.47-112.47,3.37h0S8.29,31.4,2.82,54.39c-2.2,10.38-17.86,100.88,75.82,217.44,93.68-116.56,78.02-207.06,75.82-217.44Zm-36.65,27.24c-.25,10.59-6.62,22.28-14.48,29.13-8.78,7.65-19.46,10.36-30.83,10.36s-21.67-6.62-29.13-14.48c-7.8-8.21-10.62-19.84-10.36-30.83,.25-10.59,6.62-22.28,14.48-29.13,8.78-7.65,19.46-10.36,30.83-10.36s21.67,6.62,29.13,14.48c7.8,8.21,10.62,19.84,10.36,30.83Z"; stroke:#1d1d1b; stroke-miterlimit:10;/></svg> Kontakt</a></li>
                <?php if ($user->isLoggedIn()): ?>
                    <li> <a href="/post/create">Posts</a></li>
                    <li> <a href="/dashboard">Dashboard</a></li>
                    <li> <a id="logout-btn" href="/logout">Ausloggen</a></li>
                <?php else: ?>
                    <li><a class="" href="/login">Einloggen</a></li>
                    <li><a class="" href="/register">Registrieren</a></li>
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
