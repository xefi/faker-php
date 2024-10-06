<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use ReflectionClass;
use Xefi\Faker\Container\Container;

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
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < count($this->latinWords); $i++) {
            $results[] = $faker->unique()->word();
        }

        $this->assertEqualsCanonicalizing(
            $this->latinWords,
            $results
        );
    }

    public function testWords(): void
    {
        $faker = new Container(false);

        $results = $faker->words(40);

        $this->assertCount(40, $results);

        foreach ($results as $result) {
            $this->assertContains($result, $this->latinWords);
        }
    }

    public function testSentence(): void
    {
        $faker = new Container(false);

        $result = $faker->sentence(40);

        $words = explode(' ', $result);
        $this->assertCount(40, $words);

        foreach ($words as $word) {
            $this->assertContains(strtolower($word), $this->latinWords);
        }
    }
}
