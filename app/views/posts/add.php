<?php require APPROOT . '/views/layout/header.php' ?>

<a href="<?= URLROOT ?>/posts" class="btn btn-light">
    <i class="fa fa-backward"></i>
    Back
</a>

<div class="card card-body bg-light mt-5">

    <h2>Add Post</h2>
    <p>Create a post with this form</p>
    <form action="<?= URLROOT ?>/posts/add" method="post">

        <div class="form-group mb-3">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title" id="" class="form-control form-control-lg
                     <?= (!empty($data['title_error'])) ? 'is-invalid' : '' ?>" value="<?= $data['title'] ?>">
            <span class="invalid-feedback">
                <?= $data['title_error'] ?>
            </span>
        </div>

        <div class="form-group mb-3">
            <label for="body">Body: <sup>*</sup></label>
            <textarea name="body" id="" class="form-control form-control-lg
                     <?= (!empty($data['body_error'])) ? 'is-invalid' : '' ?>">
                     <?= $data['body'] ?> </textarea>
            <span class="invalid-feedback">
                <?= $data['body_error'] ?>
            </span>
        </div>

        <input type="submit" value="Submit" class="btn btn-success">

    </form>
</div>
</div>
</div>
<?php require APPROOT . '/views/layout/footer.php' ?>