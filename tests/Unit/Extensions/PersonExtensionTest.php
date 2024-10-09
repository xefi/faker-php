<?php

namespace Extensions;

use ReflectionClass;
use Xefi\Faker\Container\Container;
use Xefi\Faker\Extensions\PersonExtension;
use Xefi\Faker\Tests\Unit\Extensions\TestCase;

final class PersonExtensionTest extends TestCase
{
    protected array $firstNameMale = [];
    protected array $firstNameFemale = [];
    protected array $lastName = [];
    protected array $titleMale = [];
    protected array $titleFemale = [];

    protected function setUp(): void
    {
        parent::setUp();

        $personExtension = new \Xefi\Faker\Extensions\PersonExtension(new \Random\Randomizer());
        $this->firstNameMale = (new ReflectionClass($personExtension))->getProperty('firstNameMale')->getValue($personExtension);
        $this->firstNameFemale = (new ReflectionClass($personExtension))->getProperty('firstNameFemale')->getValue($personExtension);
        $this->lastName = (new ReflectionClass($personExtension))->getProperty('lastName')->getValue($personExtension);
        $this->titleMale = (new ReflectionClass($personExtension))->getProperty('titleMale')->getValue($personExtension);
        $this->titleFemale = (new ReflectionClass($personExtension))->getProperty('titleFemale')->getValue($personExtension);
    }

    public function testFirstNameFemale(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < count($this->firstNameFemale); $i++) {
            $results[] = $faker->unique()->firstName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameFemale,
            $results
        );
    }

    public function testFirstNameMale(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < count($this->firstNameMale); $i++) {
            $results[] = $faker->unique()->firstName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameMale,
            $results
        );
    }

    public function testFirstName(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < count($this->firstNameFemale) + count($this->firstNameMale); $i++) {
            $results[] = $faker->unique()->firstName();
        }

        $this->assertEqualsCanonicalizing(
            array_merge($this->firstNameFemale, $this->firstNameMale),
            $results
        );
    }

    public function testLastName(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < count($this->lastName); $i++) {
            $results[] = $faker->unique()->lastName();
        }

        $this->assertEqualsCanonicalizing(
            $this->lastName,
            $results
        );
    }

    public function testNameMale(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $faker->name(PersonExtension::GENDER_MALE);
        }

        foreach ($results as $result) {
            $implode = explode(' ', $result);
            $this->assertContains($implode[0], $this->firstNameMale);
            $this->assertContains($implode[1], $this->lastName);
        }
    }

    public function testNameFemale(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $faker->name(PersonExtension::GENDER_FEMALE);
        }

        foreach ($results as $result) {
            $implode = explode(' ', $result);
            $this->assertContains($implode[0], $this->firstNameFemale);
            $this->assertContains($implode[1], $this->lastName);
        }
    }

    public function testName(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $faker->name();
        }

        foreach ($results as $result) {
            $implode = explode(' ', $result);
            $this->assertContains($implode[0], array_merge($this->firstNameFemale, $this->firstNameMale));
            $this->assertContains($implode[1], $this->lastName);
        }
    }

    public function testTitleFemale(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < count($this->titleFemale); $i++) {
            $results[] = $faker->unique()->title(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->titleFemale,
            $results
        );
    }

    public function testTitleMale(): void
    {
        $faker = new Container(false);

        $results = [];
        for ($i = 0; $i < count($this->titleMale); $i++) {
            $results[] = $faker->unique()->title(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->titleMale,
            $results
        );
    }

    public function testTitle(): void
    {
        $faker = new Container(false);

        $titles = array_unique(array_merge($this->titleFemale, $this->titleMale));

        $results = [];
        for ($i = 0; $i < count($titles); $i++) {
            $results[] = $faker->unique()->title();
        }

        $this->assertEqualsCanonicalizing(
            $titles,
            $results
        );
    }
}
