<h1 class="headline">Einloggen</h1>

<div class="form-container">
    <form action="" method="post" novalidate>

        <input type="hidden" name="csrfToken" value="<?= $csrfToken ?>">

        <?php if (isset($errors['root'])): ?>
            <?php foreach ($errors['root'] as $error): ?>
                <div class="message error"><?= $error ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="input-group">
            <?php if (isset($errors['username'])): ?>
                <?php foreach ($errors['username'] as $error): ?>
                    <div class="message error"><?= $error ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="form-group">        
                <label for="username">Nutzername</label>
                <input type="text" name="username" id="username">
            </div>
        </div>

        <div class="input-group">
            <?php if (isset($errors['password'])): ?>
                <?php foreach ($errors['password'] as $error): ?>
                    <div class="message error"><?= $error ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="form-group">          
                <label for="password">Passwort</label>
                <input type="password" name="password" id="password">
            </div>
        </div>

        <div class="form-group">
            <input type="submit" value="Einloggen">
        </div>

        <p>Du hast noch keinen Account? <a class="link-btn" href="/register">Registrieren</a></p>
    </form>
</div>