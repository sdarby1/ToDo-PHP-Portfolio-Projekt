
<div class="post-container">
    <div class="post">
        <h2 class="post-headline"><?=$post->getTitle()?></h2>

        <?php foreach ($post->getImages() as $image): ?>
            <img src="<?= $image ?>">
        <?php endforeach; ?>

        <p><?=$post->getBody()?></p>
        <div>Gepostet am: <?=$post->getCreatedAt()?></div>
    </div>
</div>