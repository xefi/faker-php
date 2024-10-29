<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use PHPUnit\Framework\Attributes\DataProvider;
use ReflectionClass;

final class TextExtensionTest extends TestCase
{
    protected array $paragraphs = [];

    protected function setUp(): void
    {
        parent::setUp();

        $testExtension = new \Xefi\Faker\Extensions\TextExtension(new \Random\Randomizer());
        $this->paragraphs = (new ReflectionClass($testExtension))->getProperty('paragraphs')->getValue($testExtension);
    }

    public function testWordsWithDefaultValue(): void
    {
        $sentences = array_merge(...$this->paragraphs);
        $words = array_merge(...$sentences);
        $wordsWithoutPunctuationAndLowercased = array_map(function (string $word) { return strtolower(preg_replace('/[.,]/', '', $word)); }, $words);
        $result = $this->faker->words();

        $this->assertCount(3, explode(' ', $result));
        foreach (explode(' ', $result) as $word) {
            $this->assertContains($word, $wordsWithoutPunctuationAndLowercased);
        }
    }


    public static function wordsProvider()
    {
        return [
            [1],
            [2],
            [3],
            [4],
            [5],
            [6],
            [7],
            [8],
            [9],
            [10]
        ];
    }

    #[DataProvider('wordsProvider')]
    public function testWords(int $count): void
    {
        $sentences = array_merge(...$this->paragraphs);
        $words = array_merge(...$sentences);
        $wordsWithoutPunctuationAndLowercased = array_map(function (string $word) { return strtolower(preg_replace('/[.,]/', '', $word)); }, $words);
        $result = $this->faker->unique()->words($count);

        $this->assertCount($count, explode(' ', $result));
        foreach (explode(' ', $result) as $word) {
            $this->assertContains($word, $wordsWithoutPunctuationAndLowercased);
        }
    }

    public function testSentencesWithDefaultValue(): void
    {
        $sentences = array_merge(...$this->paragraphs);
        $words = array_merge(...$sentences);
        $result = $this->faker->sentences();

        $this->assertCount(3, array_filter(explode('.', $result)));
        foreach (explode(' ', $result) as $word) {
            $this->assertContains($word, $words);
        }
    }


    public static function sentencesProvider()
    {
        return [
            [1],
            [2],
            [3],
            [4],
            [5],
            [6],
            [7],
            [8],
            [9],
            [10]
        ];
    }

    #[DataProvider('sentencesProvider')]
    public function testSentences(int $count): void
    {
        $sentences = array_merge(...$this->paragraphs);
        $words = array_merge(...$sentences);
        $result = $this->faker->unique()->sentences($count);

        $this->assertCount($count, array_filter(explode('.', $result)));
        foreach (explode(' ', $result) as $word) {
            $this->assertContains($word, $words);
        }
    }

    public function testParagraphsWithDefaultValue(): void
    {
        $sentences = array_merge(...$this->paragraphs);
        $words = array_merge(...$sentences);
        $result = $this->faker->paragraphs();

        $this->assertCount(3, array_filter(explode(PHP_EOL, $result)));
        foreach (preg_split('/\s+/', $result) as $word) {
            $this->assertContains($word, $words);
        }
    }


    public static function paragraphsProvider()
    {
        return [
            [1],
            [2],
            [3],
            [4],
            [5],
        ];
    }

    #[DataProvider('paragraphsProvider')]
    public function testParagraphs(int $count): void
    {
        $sentences = array_merge(...$this->paragraphs);
        $words = array_merge(...$sentences);
        $result = $this->faker->unique()->paragraphs($count);

        $this->assertCount($count, array_filter(explode(PHP_EOL, $result)));
        foreach (preg_split('/\s+/', $result) as $word) {
            $this->assertContains($word, $words);
        }
    }
}
