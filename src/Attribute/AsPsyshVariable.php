<?php

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
class AsPsyshVariable
{
    public function __construct(public string $variable) {
    }
}
