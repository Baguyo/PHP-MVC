

<nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3 p-2">
    <div class="container">
        <a class="navbar-brand" href="<?= URLROOT ?>"><?= SITENAME ?></a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link " href="<?= URLROOT ?>" aria-current="page">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT; ?>/pages/about">About</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#" aria-current="page">Welcome <?= $_SESSION['user_name'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URLROOT ?>/users/logout" aria-current="page">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URLROOT ?>/users/register" aria-current="page">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URLROOT; ?>/users/login">Login</a>
                    </li>
                <?php endif; ?>

            </ul>

        </div>
    </div>
</nav>