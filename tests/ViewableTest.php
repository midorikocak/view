<?php

declare(strict_types=1);

namespace midorikocak\view;

use PHPUnit\Framework\TestCase;

use function reset;

class ViewableTest extends TestCase
{
    private array $articleData;
    private Article $article;

    public function setUp(): void
    {
        parent::setUp();
        $this->articleData = [
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

        $this->article = new Article($this->articleData['title'], $this->articleData['created']);

        $sectionData = reset($this->articleData['sections']);
        $section = new Section($sectionData['title']);

        $section->addParagraph($sectionData['content'][0]);
        $section->addParagraph($sectionData['content'][1]);
        $section->addParagraph($sectionData['content'][2]);

        $this->article->addSection($section);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->article, $this->articleData);
    }

    public function testRenderArticle(): void
    {
        $this->article->template = 'tests/View/posts/post.php';
        $this->assertNotEmpty($this->article->render());
    }
}
