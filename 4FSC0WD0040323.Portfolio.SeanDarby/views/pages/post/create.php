


    <h1 class="headline">Erstelle einen neuen Post</h1>

<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrfToken" value="<?= $csrfToken ?>">

    <div class="input-group">
        <?php if (isset($errors['title'])): ?>
            <?php foreach ($errors['title'] as $error): ?>
                <div class="message error"><?= $error ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="form-group">          
            <label for="title">Titel</label>
            <input type="text" name="title" id="title">
        </div>
    </div>

    <div class="input-group">
        <?php if (isset($errors['body'])): ?>
            <?php foreach ($errors['body'] as $error): ?>
                <div class="message error"><?= $error ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="form-group">        
            <label for="body">Body</label>
            <textarea name="body" id="body"></textarea>
        </div>
    </div>

    <div class="input-group">
        <?php if (isset($errors['image'])): ?>
            <?php foreach ($errors['image'] as $error): ?>
                <div class="message error"><?= $error ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="form-group">          
            <label for="image">Bild hochladen</label>
            <input type="file" name="image" id="image">
        </div>
    </div>
    <div class="form-group">
        <input type="submit" value="Create Post">
    </div>
</form>

</form>
