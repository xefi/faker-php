<?php

namespace Xefi\Faker\Providers;

use Xefi\Faker\Container;

class ProviderRepository
{
    /**
     * Register the application service providers.
     *
     * @param  array  $providers
     * @return void
     */
    public function load(array $providers)
    {
        foreach ($providers as $provider) {
            $instance = $this->createProvider($provider);

            $instance->boot();
        }
    }


    /**
     * Create a new provider instance.
     *
     * @param  string  $provider
     * @return \Xefi\Faker\Providers\Provider
     */
    public function createProvider($provider)
    {
        return new $provider();
    }
}