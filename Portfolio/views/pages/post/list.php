<!-- post/list.php -->

<?php foreach ($posts as $post): ?>
    <div class="post-container">
        <div class="post">
            <h1><?= $post['title'] ?></h1>

            <!-- Anzeige des Bildes (du musst den Bildpfad anpassen) -->
            <img src="<?= $post['image_path'] ?>" alt="Post Image">

            <p><?= $post['body'] ?></p>
            <div>Posted by User ID: <?= $post['user_id'] ?></div>
        </div>
    </div>
<?php endforeach; ?>
