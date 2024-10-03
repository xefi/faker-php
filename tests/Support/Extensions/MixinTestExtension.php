<?php

namespace Xefi\Faker\Tests\Support\Extensions;

use Xefi\Faker\Extensions\Extension;

class MixinTestExtension extends Extension
{
    public function withoutParameters()
    {
    }

    public function withNoTypeParameters($one, $two)
    {
    }

    public function withTypedParameters(int $one, string $two)
    {
    }

    public function withVoidReturnType(): void
    {
    }

    public function withStringReturnType(): string
    {
        return 'string';
    }
}
