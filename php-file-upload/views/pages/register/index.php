<main>
    <h1 class="headline">Registrieren</h1>
    <div class="form-container">
        <form action="" method="post" novalidate>
            <?php if (isset($errors['root'])): ?>
                <?php foreach ($errors['root'] as $error): ?>
                    <div class="message error"><?=$error?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="input-group">
                <?php if (isset($errors['email'])): ?>
                    <?php foreach ($errors['email'] as $error): ?>
                        <div class="message error"><?=$error?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="form-group">        
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="test@domain.com">
                </div>
            </div>

            <div class="input-group">
                <?php if (isset($errors['username'])): ?>
                    <?php foreach ($errors['username'] as $error): ?>
                        <div class="message error"><?=$error?></div>
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
                        <div class="message error"><?=$error?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="form-group">         
                    <label for="password">Passwort</label>
                    <input type="password" name="password" id="password">
                </div>    
            </div>

            <div class="input-group">
                <?php if (isset($errors['passwordAgain'])): ?>
                    <?php foreach ($errors['passwordAgain'] as $error): ?>
                        <div class="message error"><?=$error?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="form-group"> 
                    <label for="password-again">Passwort wiederholen</label>
                    <input type="password" name="passwordAgain" id="password-again">
                </div>     
            </div>

            <div class="form-group-service">
                <label class="service-label" for="terms-of-service">Den Nutzungsbedingungen zustimmen</label>
                <input type="checkbox" name="termsOfService" id="terms-of-service">
            </div>

            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</main>
