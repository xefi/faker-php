<?php

class LocaleTest extends \Xefi\Faker\Tests\Unit\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        (new \Xefi\Faker\Container\Container())->resolveExtensions([
            \Xefi\Faker\Tests\Support\Extensions\EnEnExtensionTest::class,
            \Xefi\Faker\Tests\Support\Extensions\EnUsExtensionTest::class,
            \Xefi\Faker\Tests\Support\Extensions\FrFrExtensionTest::class,
        ]);
    }

    public function testExtensionsCorrectlyRegistered()
    {
        $this->assertEquals(
            [
                'locales' => [
                    'en-EN' => new \Xefi\Faker\Tests\Support\Extensions\EnEnExtensionTest(new \Random\Randomizer()),
                    'en-US' => new \Xefi\Faker\Tests\Support\Extensions\EnUsExtensionTest(new \Random\Randomizer()),
                    'fr-FR' => new \Xefi\Faker\Tests\Support\Extensions\FrFrExtensionTest(new \Random\Randomizer()),
                ],
            ],
            (new \Xefi\Faker\Container\Container())->getExtensions()['locale-extension-test']
        );
    }

    public function testCallingDefaultExtension()
    {
        $this->assertEquals(
            'en-US',
            (new \Xefi\Faker\Faker())->returnLocale()
        );
    }

    public function testUsingDefaultLocale()
    {
        $faker = new Xefi\Faker\Faker('fr-FR');
        $this->assertEquals(
            'fr-FR',
            $faker->returnLocale()
        );

        $this->assertEquals(
            'fr-FR',
            $faker->locale('fr-FR')->returnLocale()
        );

        $this->assertEquals(
            'en-EN',
            $faker->locale('en-EN')->returnLocale()
        );

        $this->assertEquals(
            'fr-FR',
            $faker->returnLocale()
        );

        $this->assertEquals(
            'en-US',
            $faker->locale('en-US')->returnLocale()
        );
    }
}
