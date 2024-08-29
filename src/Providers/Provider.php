<?php

namespace Xefi\Faker\Providers;

use Xefi\Faker\Container\Container;

class Provider
{
    /**
     * Register the package's custom Faker extensions.
     *
     * @param array $extensions
     *
     * @return void
     */
    public function extensions(array $extensions)
    {
        Container::starting(function (Container $container) use ($extensions) {
            $container->resolveExtensions($extensions);
        });
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        //
    }
}
