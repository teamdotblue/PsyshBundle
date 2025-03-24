<?php

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class AsPsyshVariable
{
    /** If no variable is given, the name of the class will be used as variable name */
    public function __construct(public ?string $variable = null)
    {
    }
}
