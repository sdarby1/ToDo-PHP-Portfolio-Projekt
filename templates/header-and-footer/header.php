<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/header-and-footer.css">
    <link rel="stylesheet" href="styles/register-form.css">
    <link rel="stylesheet" href="styles/login-form.css">
    <script type="text/javascript" src="scripts/validate.js" defer></script>
    <script type="text/javascript" src="scripts/navbar.js" defer></script>
    <title><?php echo $pageTitle; ?></title>
</head>
<body>
    <header>
        <a href="index.php"><img class="logo" src="images/logo.svg"></a>
        <h1 class="doc-title"><?php echo $pageTitle; ?></h1>
        <nav id="header-nav" class="header-nav">
        <?php
                    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
                    if (!empty($username)) {
                        $initial = strtoupper(substr($username, 0, 1));
                        echo '<a class="profile-picture-btn" href="account.php"><div class="profile-circle"><span>' . $initial . '</span></div></a>';
                        echo '<span class="greeting">Hallo ' . $username . '!</span>';
                    }
                    ?>
            <ul>
                <li> <a class="refresh" href="index.php">Home</a></li>
                <li> <a class="refresh" href="login-form.php">Einloggen</a></li>
                <li> <a class="refresh" href="account.php">Account</a></li>
                <?php
                if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
                    echo '<li><a class="refresh" href="todo.php">To Do Liste</a></li>';
                }
                ?>
                <?php
                if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
                    echo '<li><a class="refresh" id="log-out-btn" href="logout.php">Abmelden</a></li>';
                }
                ?>
            </ul>
        </nav>

        <div id="hamburger-menu">
            <div class="bar1 allBars"></div>
            <div class="bar2 allBars"></div>
            <div class="bar3 allBars"></div>
        </div>
    </header>
    <main>