<?php

namespace Xefi\Faker\Tests\Support\Extensions;

use Xefi\Faker\Extensions\Extension;
use Xefi\Faker\Extensions\Traits\HasLocale;

class EnEnExtensionTest extends Extension
{
    use HasLocale;

    public function getName(): string
    {
        return 'locale-extension-test';
    }

    public function getLocale(): string
    {
        return 'en-EN';
    }

    public function returnLocale()
    {
        return $this->getLocale();
    }
}
