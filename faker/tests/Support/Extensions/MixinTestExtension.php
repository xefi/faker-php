<?php

namespace Xefi\Faker\Tests\Support\Extensions;

use Xefi\Faker\Extensions\Extension;

class MixinTestExtension extends Extension
{
    public function withoutParameters() {
        return;
    }

    public function withNoTypeParameters($one, $two) {
        return;
    }

    public function withTypedParameters(int $one, string $two) {
        return;
    }

    public function withVoidReturnType(): void {
        return;
    }

    public function withStringReturnType(): string {
        return 'string';
    }
}