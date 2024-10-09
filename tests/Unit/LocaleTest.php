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
                    null => new \Xefi\Faker\Tests\Support\Extensions\NullLocaleExtensionTest(new \Random\Randomizer()),
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
            null,
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
