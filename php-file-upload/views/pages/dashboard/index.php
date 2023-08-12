<h1 class="headline">Dashboard</h1>

<div class="dashboard-container">
    <h2 class="dashboard-headline">Deine Posts</h2>

    <?php if (!count($posts)): ?>
        Du hast keine Posts.
    <?php endif; ?>

    <?php foreach ($posts as $post): ?>
        <div class="your-posts-container">
            <a class="your-post"  href="/post/<?= $post->getId() ?>"><?= $post->getTitle() ?></a>
            <a href="/post/delete/<?= $post->getId() ?>?csrfToken=<?= $csrfToken ?>">Löschen</a>
            <a href="/post/edit/<?= $post->getId() ?>">Bearbeiten</a>
        </div>
    <?php endforeach; ?>
</div>