<?php

namespace Xefi\Faker\Tests\Unit\Extensions;

use Random\Randomizer;

final class ArraysExtensionTest extends TestCase
{
    protected array $testArray = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->testArray = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
    }

    public function testRandomElement(): void
    {
        $elements = [];
        for ($i = 0; $i < count($this->testArray); $i++) {
            $elements[] = $this->faker->unique()->randomElement($this->testArray);
        }

        $this->assertEqualsCanonicalizing($elements, $this->testArray);
    }

    public function testRandomKeyNumber(): void
    {
        $elements = [];
        for ($i = 0; $i < count($this->testArray); $i++) {
            $elements[] = $this->faker->unique()->randomKeyNumber($this->testArray);
        }

        $this->assertEqualsCanonicalizing($elements, array_keys($this->testArray));
    }

    public function testRandomKey(): void
    {
        $inputArray = [
            ['firstname' => 'John'],
            ['lastname'  => 'Doe'],
            ['nickname'  => 'Johnny'],
            ['login'     => 'j.doe']
        ];

        $result = $this->faker->randomKey($inputArray);
        $this->assertContains($result, ['firstname', 'lastname', 'nickname', 'login']);
    }
}
