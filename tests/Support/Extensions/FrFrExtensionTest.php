<?php

namespace Xefi\Faker\Tests\Support\Extensions;

use Xefi\Faker\Extensions\Extension;
use Xefi\Faker\Extensions\Traits\HasLocale;

class FrFrExtensionTest extends Extension
{
    use HasLocale;

    public function getName(): string
    {
        return 'locale-extension-test';
    }

    public function getLocale(): ?string
    {
        return 'fr_FR';
    }

    public function returnLocale()
    {
        return $this->getLocale();
    }
}
