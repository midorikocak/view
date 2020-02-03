<?php

declare(strict_types=1);

// phpcs:disable

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <style>
        body {
            margin: 0 auto;
            max-width: 50em;
            font-family: "Helvetica", "Arial", sans-serif;
            line-height: 1.5;
            padding: 4em 1em;
            color: #555;
        }

        a {
            color: #e81c4f;
        }

        h2 {
            margin-top: 1em;
            padding-top: 1em;
        }

        h1,
        h2,
        strong {
            color: #333;
        }
    </style>
</head>
<body>
<header>
    <?= /** @var string $header */ $header ?>
</header>
<main>
    <?= /** @var string $main */ $main ?>
</main>
<nav>
    <?= /** @var string $nav */ $nav ?>
</nav>
<footer>
    <?= /** @var string $footer */ $footer ?>
</footer>
</body>
</html>
