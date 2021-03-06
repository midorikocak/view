# View

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

View is the V in MVC. A small library to include in your MVC projects. 
Allows you to separate presentation layer from the rest of your application.

**Note:** It's your responsibility to check user inputs. This library just renders templates. Nothing else.

## Install

Via Composer

``` bash
$ composer require midorikocak/view
```

## Usage

Let's say you have blog post data like this:

```php
$articleData = [
    'title' => 'Writing object oriented software is an art.',
    'sections' => [
        [
            'title' => 'Introduction',
            'content' => [
                'Some people say that you have to be genius, or man,
        but they mostly does not undertsand what is humble programming.
        Programming should be a modest person\'s craft.',
                'Generally those people does exclude others, create clickbait articles,
            they make you feel less confident.',
                'Do not care about them and just try to create things. Learn. Be hungry.',
            ],
        ],
    ],
    'created' => '2020-01-25 00:00:00',
];
```

And you want to render an article using template like this:

```php
// template.php
<?php
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
```

You can use default FileRenderer to extract your php files with variables. 
And you can render your plain php files with variables:

```php
$renderer = new FileRenderer();
$view = new View($this->renderer);
$view->setTemplate('template.php');
echo $this->view->render($this->articleData);
```
This should output rendered html as this with variables rendered:

```html
<article>
    <header>
        <h2>Writing object oriented software is an art.</h2>
    </header>
    <section>
        <h3>Introduction</h3>
        <p>Some people say that you have to be genius, or man, 
but they mostly does not undertsand what is humble programming. 
Programming should be a modest person's craft.</p>
        <p>Generally those people does exclude others, create clickbait articles, 
they make you feel less confident.</p>
        <p>Do not care about them and just try to create things. Learn. Be hungry.</p>
    </section>
    <footer>
        <time datetime="1579910400">Sat, 25 2020</time>
    </footer>
</article>
```

***Note:*** Extracting variable into runtime can be unsecure.

## Plain templates

If you have plain templates with placemarks as `{{ someVariable }}` you can use
`TemplateRenderer`

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ title }}</title>
</head>
<body>
<article>
    <header>
        <h2>{{ title }}</h2>
    </header>
    <section>
        <h3>{{ sectionTitle }}</h3>
        <p>{{ paragraph }}</p>
    </section>
    <footer>
        <time datetime="{{ created }}">
            {{ formatted }}
        </time>
    </footer>
</article>
</body>
</html>
```

To render this template using some data:

```php
$templateRenderer = new TemplateRenderer();
$view = new View($templateRenderer);
$view->setTemplate('tests/View/plain.template.html');
$this->assertNotEmpty($view->render(
    [
        'title' => 'Object Oriented Programming',
        'sectionTitle' => 'Introduction',
        'parapgraph' => 'Writing object oriented software is an art.',
        'created' => '2020-01-25 00:00:00',
        'formatted' => 'Mon 25, 2020',
    ]
));
```
This should output rendered html as this with variables rendered:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Object Oriented Programming</title>
</head>
<body>
<article>
    <header>
        <h2>Object Oriented Programming</h2>
    </header>
    <section>
        <h3>Introduction</h3>
        <p></p>
    </section>
    <footer>
        <time datetime="2020-01-25 00:00:00">
            Mon 25, 2020
        </time>
    </footer>
</article>
</body>
</html>
```

## Using Blade Templates

To use Blade templates, use the included `BladeRenderer`.

```php
$bladeRenderer = new BladeRenderer('tests/View', '/tmp');
$view = new View($bladeRenderer);
$view->setTemplate('app');
echo $view->render(
    [
        'title' => 'OOP',
        'content' => 'Writing object oriented software is an art.',
    ]
);
```

### Custom Renderers

To create your own renderer or extend the library with another renderer library, implement `RendererInterface`

```php
<?php

declare(strict_types=1);

namespace midorikocak\view;

interface RendererInterface
{
    public function render(string $template, array $data): string;
}
```

### Rendering data objects

If you have data objects that implement a `toArray()` method, you can use `ViewableTrait` with them. 
So in your controllers you can write code like this:

```php
$article->template = 'tests/View/posts/post.php';
echo $article->render();
```

### Custom Viewers in data objects

You can change the viewer object of your data object by accessing it with the viewer that you initialized using custom renderer.

```php
$templateRenderer = new TemplateRenderer();
$view = new View($templateRenderer);

$article->view = $view;
$article->template = 'tests/View/plain.template.html';

echo $article->render();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email mtkocak@gmail.com instead of using the issue tracker.

## Credits

- [Midori Kocak][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/midorikocak/view.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/midorikocak/view/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/midorikocak/view.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/midorikocak/view.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/midorikocak/view.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/midorikocak/view
[link-travis]: https://travis-ci.org/midorikocak/view
[link-scrutinizer]: https://scrutinizer-ci.com/g/midorikocak/view/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/midorikocak/view
[link-downloads]: https://packagist.org/packages/midorikocak/view
[link-author]: https://github.com/midorikocak
[link-contributors]: ../../contributors
