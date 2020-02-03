<?php

declare(strict_types=1);

namespace midorikocak\view;

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    private View $view;
    private FileRenderer $renderer;
    private array $postData;
    private array $layoutData;

    public function setUp(): void
    {
        parent::setUp();
        $this->postData = [
            'title' => 'Writing object oriented software is an art.',
            'sections' => [
                [
                    'title' => 'Introduction',
                    'content' => [
                        'Some people say that you have to be genius, or man,
                but they mostly does not undertsand what is humble programming.
                Programming should be a modest person\'s craft.',
                        'Generally those people does exclude others, create clickbait articles,
                    they make you feel less confidesnt.',
                        'Do not care about them and just try to create things. Learn. Be hungry.',
                    ],
                ],
            ],
            'created' => '2020-01-25 00:00:00',
        ];

        $this->layoutData = [
            'header' => '',
            'main' => '',
            'nav' => '',
            'footer' => '',
        ];

        $this->renderer = new FileRenderer();
        $this->view = new View($this->renderer);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->api);
    }

    public function testRenderTemplate()
    {
        $this->view->setTemplate('tests/View/posts/post.php');
        $this->assertNotEmpty($this->view->render($this->postData));
    }

    public function testRenderLayout()
    {
        $this->view->setTemplate('tests/View/posts/post.php');
        $post = $this->view->render($this->postData);

        $this->layoutData['main'] = $post;

        $this->view->setTemplate('tests/View/layouts/public.php');
        $this->assertNotEmpty($this->view->render($this->layoutData));
    }

    public function testBlade()
    {
        $bladeRenderer = new BladeRenderer('tests/View', '/tmp');
        $view = new View($bladeRenderer);
        $view->setTemplate('app');
        $this->assertNotEmpty($view->render(
            [
                'title' => 'OOP',
                'content' => 'Writing object oriented software is an art.',
            ]
        ));
    }

    public function testPlain()
    {
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
    }
}
