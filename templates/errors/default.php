<?php

/** @var string $errorMessage */ ?>

<?php require_once APP_ROOT . "/templates/header.php" ?>
<section class="text-gray-600 body-font">
    <div class="container flex flex-wrap px-5 py-24 mx-auto items-center">
        <h1 class="te"><?= $errorMessage ?></h1>
    </div>
</section>
<?php require_once APP_ROOT . "/templates/footer.php" ?>