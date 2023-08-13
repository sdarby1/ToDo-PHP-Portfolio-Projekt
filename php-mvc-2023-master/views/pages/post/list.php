<h1 class="headline">Posts</h1>

<?php 
    var_dump($posts);
?>


<?php foreach ($posts as $post): ?>
    <div class="post">
        <h2 class="post-headline"><?= $post['title']?></h2>

        <?php foreach ($post['images'] as $image): ?>
            <img src="<?= $image ?>">
        <?php endforeach; ?>

        <p><?=$post->getBody()?></p>
        <div>Gepostet am: <?=$post->getCreatedAt()?></div>
        <div>Likes: <?=$post->getLikeCount()?></div>

        <?php if ($user->isLoggedIn()): ?>
            <?php if ($post->isLikedBy($user)): ?>
                <a href="/post/dislike/<?= $post->getId() ?>?csrfToken=<?= $csrfToken ?>">Dislike</a>
            <?php else: ?>
                <a href="/post/like/<?= $post->getId() ?>?csrfToken=<?= $csrfToken ?>">Like</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endforeach; ?>