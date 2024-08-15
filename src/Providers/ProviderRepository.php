<?php

namespace Xefi\Faker\Providers;

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
    public function createProvider($provider): Provider
    {
        if (is_object($provider)){
            return $provider;
        }

        return new $provider();
    }
}