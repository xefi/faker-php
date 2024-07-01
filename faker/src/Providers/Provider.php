<?php

namespace Xefi\Faker\Providers;

use Xefi\Faker\Container;

class Provider
{
    /**
     * Register the package's custom Faker extensions.
     *
     * @param  array  $extensions
     * @return void
     */
    public function extensions(array $extensions)
    {
        Container::starting(function ($container) use ($extensions) {
            $container->resolveCommands($extensions);
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