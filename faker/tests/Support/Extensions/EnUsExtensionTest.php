<?php

namespace Xefi\Faker\Tests\Support\Extensions;

use Xefi\Faker\Extensions\Extension;
use Xefi\Faker\Extensions\Traits\HasLocale;

class EnUsExtensionTest  extends Extension
{
    // No locale definition because defaulting to 'en-US'
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