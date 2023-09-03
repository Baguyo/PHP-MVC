<?php require APPROOT . '/views/layout/header.php' ?>
<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
    <h1 class="display-3">  <?= $data['title'] ?> </h1>
      <p class="lead">
        <?= $data['description'] ?>
      </p>
    </div>
  </div>

<?php require APPROOT . '/views/layout/footer.php' ?>