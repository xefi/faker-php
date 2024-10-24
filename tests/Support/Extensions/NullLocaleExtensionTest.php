<?php

namespace Xefi\Faker\Tests\Support\Extensions;

use Xefi\Faker\Extensions\Extension;
use Xefi\Faker\Extensions\Traits\HasLocale;

class NullLocaleExtensionTest extends Extension
{
    use HasLocale;

    public function getName(): string
    {
        return 'locale-extension-test';
    }

    public function returnLocale()
    {
        return $this->getLocale();
    }
}
