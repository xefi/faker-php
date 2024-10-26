<?php

class LocaleTest extends \Xefi\Faker\Tests\Unit\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        (new \Xefi\Faker\Container\Container())->resolveExtensions([
            \Xefi\Faker\Tests\Support\Extensions\NullLocaleExtensionTest::class,
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
                    null    => new \Xefi\Faker\Tests\Support\Extensions\NullLocaleExtensionTest(new \Random\Randomizer()),
                    'en_EN' => new \Xefi\Faker\Tests\Support\Extensions\EnEnExtensionTest(new \Random\Randomizer()),
                    'en_US' => new \Xefi\Faker\Tests\Support\Extensions\EnUsExtensionTest(new \Random\Randomizer()),
                    'fr_FR' => new \Xefi\Faker\Tests\Support\Extensions\FrFrExtensionTest(new \Random\Randomizer()),
                ],
            ],
            (new \Xefi\Faker\Container\Container())->getExtensions()['locale-extension-test']
        );
    }

    public function testCallingDefaultExtension()
    {
        $this->assertEquals(
            null,
            (new \Xefi\Faker\Faker())->returnLocale()
        );
    }

    public function testUsingDefaultLocale()
    {
        $faker = new Xefi\Faker\Faker('fr_FR');
        $this->assertEquals(
            'fr_FR',
            $faker->returnLocale()
        );

        $this->assertEquals(
            'fr_FR',
            $faker->locale('fr_FR')->returnLocale()
        );

        $this->assertEquals(
            'en_EN',
            $faker->locale('en_EN')->returnLocale()
        );

        $this->assertEquals(
            'fr_FR',
            $faker->returnLocale()
        );

        $this->assertEquals(
            'en_US',
            $faker->locale('en_US')->returnLocale()
        );
    }

    public function testResettingLocale()
    {
        $faker = new Xefi\Faker\Faker('fr_FR');
        $this->assertEquals(
            'fr_FR',
            $faker->returnLocale()
        );

        $this->assertEquals(
            null,
            $faker->locale(null)->returnLocale()
        );
    }

    public function testUsingNotExistingLocaleFallingBackToNullLocale()
    {
        $faker = new Xefi\Faker\Faker('not-existing-locale');
        $this->assertEquals(
            null,
            $faker->returnLocale()
        );
    }

    public function testUsingNotExistingLocaleWithoutNullLocale()
    {
        $container = new \Xefi\Faker\Container\Container();
        $container->forgetExtensions();
        $container->forgetBootstrappers();
        $container->resolveExtensions([
            \Xefi\Faker\Tests\Support\Extensions\EnEnExtensionTest::class,
            \Xefi\Faker\Tests\Support\Extensions\EnUsExtensionTest::class,
            \Xefi\Faker\Tests\Support\Extensions\FrFrExtensionTest::class,
        ]);

        $this->expectException(\Xefi\Faker\Exceptions\NoExtensionLocaleFound::class);
        $this->expectExceptionMessage('Locale \'not-existing-locale\' and \'null\' for method \'returnLocale\' was not found');

        $faker = new Xefi\Faker\Faker('not-existing-locale');
        $faker->returnLocale();
    }
}
