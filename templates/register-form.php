<?php
    $pageTitle = 'Registrieren'; 
    include_once __DIR__ . DIRECTORY_SEPARATOR . '.' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'path.php';
    include_once convertToUnixPath(__DIR__ . '/header-and-footer/header.php');
?>
<div class="main-container">
<div class="form-container">
    <form class="register-form" method="post">

        <div class="input-group">
            <?php renderErrors('username'); ?>
            <div class="form-group">
                <label for="username">Nutzername</label>
                <input type="text" name="username" id="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            </div>
        </div>

        <div class="input-group">
            <?php renderErrors('email'); ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="example@domain.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
        </div>

        <div class="input-group">
            <?php renderErrors('password'); ?>
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" id="password" name="password">
                <button type="button" id="togglePassword">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24.637" height="21.113" viewBox="0 0 24.637 21.113">
                    <path id="Icon_ionic-md-eye-off" data-name="Icon ionic-md-eye-off" d="M14.571,8.943a5.585,5.585,0,0,1,5.6,5.559,5.347,5.347,0,0,1-.4,2.034l3.271,3.244A13.144,13.144,0,0,0,26.887,14.5,13.268,13.268,0,0,0,10.1,6.941l2.419,2.4A5.54,5.54,0,0,1,14.571,8.943Zm-11.2-3.03L5.928,8.448l.517.511A13.081,13.081,0,0,0,2.25,14.5a13.288,13.288,0,0,0,17.226,7.4l.473.467,3.282,3.244L24.655,24.2,4.79,4.5Zm6.191,6.141L11.3,13.775a3.15,3.15,0,0,0-.088.72,3.343,3.343,0,0,0,3.359,3.332,3.16,3.16,0,0,0,.726-.088l1.737,1.721a5.573,5.573,0,0,1-8.066-4.97A5.492,5.492,0,0,1,9.563,12.055Zm4.827-.863,3.53,3.5.022-.176a3.343,3.343,0,0,0-3.359-3.332Z" transform="translate(-2.25 -4.5)" fill="#00a1bb"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="input-group">
            <?php renderErrors('passwordRepeat'); ?>
            <div class="form-group">
                <label for="password">Passwort wiederholen</label>
                <input type="password" id="passwordRepeat" name="passwordRepeat">
                <button type="button" id="togglePasswordRepeat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24.637" height="21.113" viewBox="0 0 24.637 21.113">
                    <path id="Icon_ionic-md-eye-off" data-name="Icon ionic-md-eye-off" d="M14.571,8.943a5.585,5.585,0,0,1,5.6,5.559,5.347,5.347,0,0,1-.4,2.034l3.271,3.244A13.144,13.144,0,0,0,26.887,14.5,13.268,13.268,0,0,0,10.1,6.941l2.419,2.4A5.54,5.54,0,0,1,14.571,8.943Zm-11.2-3.03L5.928,8.448l.517.511A13.081,13.081,0,0,0,2.25,14.5a13.288,13.288,0,0,0,17.226,7.4l.473.467,3.282,3.244L24.655,24.2,4.79,4.5Zm6.191,6.141L11.3,13.775a3.15,3.15,0,0,0-.088.72,3.343,3.343,0,0,0,3.359,3.332,3.16,3.16,0,0,0,.726-.088l1.737,1.721a5.573,5.573,0,0,1-8.066-4.97A5.492,5.492,0,0,1,9.563,12.055Zm4.827-.863,3.53,3.5.022-.176a3.343,3.343,0,0,0-3.359-3.332Z" transform="translate(-2.25 -4.5)" fill="#00a1bb"/>
                    </svg>
                </button>
            </div>
        </div>


        <div class="form-group">
            <input id="submitBtn" type="submit" value="Benutzer hinzufügen">
        </div>
        <p>Du hast bereits einen Account? <a class="link-btn" href="login-form.php">Einloggen</a></p>
    </form>
</div>
</div>
<!-- 
<div class="users-container">
    <h2>Benutzerliste</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Passwort</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['password']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div> -->
