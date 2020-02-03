<?php

// phpcs:disable

declare(strict_types=1);

if (isset($created) && $created !== '') {
    $datetime = strtotime($created);
    $formattedDate = date('D, j Y', $datetime);
}
?>
<article>
    <?php if ($title !== '') : ?>
    <header>
        <h2><?= $title ?></h2>
    </header>
    <?php endif; ?>
    <?php foreach ($sections as $section) : ?>
        <section>
            <?php if (isset($section['title'])) : ?>
            <h3><?= $section['title'] ?></h3>
            <?php endif; ?>
            <?php foreach ($section['content'] as $paragraph) : ?>
            <p><?= $paragraph ?></p>
            <?php endforeach; ?>
        </section>
    <?php endforeach; ?>
    <?php if ($created !== '') : ?>
    <footer>
        <time datetime="<?= $datetime ?>">
            <?= $formattedDate ?>
        </time>
    </footer>
    <?php endif; ?>
</article>
