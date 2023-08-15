<h1 class="headline">Posts</h1>

<div class="post-list-container">
    <?php foreach ($posts as $post): ?>
        <div class="post-container">
        <div class="post">
            <h2 class="post-headline"><?= $post['title']?></h2>

            <?php foreach ($post['images'] as $image): ?>
                <img src="<?= $image['path'] ?>">
            <?php endforeach; ?>

            <p><?=$post['body']?></p>
            <div>Gepostet am: <?=date('D, d.m.Y H:i:s', $post['created_at'])?></div>
        </div>
        </div>
    <?php endforeach; ?>
    </div>
           
