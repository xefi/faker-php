<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use ReflectionClass;

final class LoremExtensionTest extends TestCase
{
    protected array $latinWords = [];

    protected function setUp(): void
    {
        parent::setUp();

        $loremExtension = new \Xefi\Faker\Extensions\LoremExtension(new \Random\Randomizer());
        $this->latinWords = (new ReflectionClass($loremExtension))->getProperty('latinWords')->getValue($loremExtension);
    }

    public function testWord(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->latinWords); $i++) {
            $results[] = $this->faker->unique()->word();
        }

        $this->assertEqualsCanonicalizing(
            $this->latinWords,
            $results
        );
    }

    public function testWords(): void
    {
        $results = $this->faker->words(40);

        $this->assertCount(40, $results);

        foreach ($results as $result) {
            $this->assertContains($result, $this->latinWords);
        }
    }

    public function testSentence(): void
    {
        $result = $this->faker->sentence(40);

        $words = explode(' ', $result);
        $this->assertCount(40, $words);

        foreach ($words as $word) {
            $this->assertContains($word, $this->latinWords);
        }
    }
}
