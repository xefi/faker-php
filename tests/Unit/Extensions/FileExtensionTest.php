<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Container\Container;
use Xefi\Faker\Extensions\FileExtension;

final class FileExtensionTest extends TestCase
{
    protected array $mimeTypes;

    protected function setUp(): void
    {
        parent::setUp();

        $loremExtension = new FileExtension(new Randomizer());
        $this->mimeTypes = (new ReflectionClass($loremExtension))->getProperty('mimeTypes')->getValue($loremExtension);
    }

    public function testMimeType(): void
    {
        $faker = new Container(false);

        $results = [];

        for ($i = 0; $i < count(array_keys($this->mimeTypes)); $i++) {
            $results[] = $faker->unique()->mimeType();
        }

        foreach ($results as $result) {
            $this->assertContains($result, array_keys($this->mimeTypes));
        }
    }

    public function testFileExtension(): void
    {
        $faker = new Container(false);

        $results = [];

        for ($i = 0; $i < count($this->mimeTypes); $i++) {
            $results[] = $faker->unique()->fileExtension();
        }

        $this->assertEqualsCanonicalizing(array_values($this->mimeTypes), $results);
    }
}
