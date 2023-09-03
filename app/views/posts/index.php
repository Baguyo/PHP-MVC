<?php require APPROOT . '/views/layout/header.php' ?>

<?php flash('post_message') ?>

<div class="row mb-3">
    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?= URLROOT ?>/posts/add" class="btn btn-primary float-end">
            <i class="fa fa-pencil"></i> Add Post
        </a>
    </div>
</div>

<?php foreach ($data['posts'] as $post) : ?>
    <div class="card mb-3">
        <div class="card-header">
            <h5><?= $post->title ?></h5>
        </div>
        <div class="card-body">
            <p>Written By: <?= $post->name ?> on <?= $post->postCreated ?></p>
            <p>
                <?= $post->body ?>
            </p>
            <a href="<?= URLROOT ?>/posts/show/<?= $post->postId ?>" class="btn btn-dark">More.</a>
        </div>

    </div>
<?php endforeach; ?>

<?php require APPROOT . '/views/layout/footer.php' ?>