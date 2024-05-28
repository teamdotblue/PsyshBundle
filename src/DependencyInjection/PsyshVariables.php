<?php

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle\DependencyInjection;

final class PsyshVariables
{
    /** @param array<string, mixed> $variables */
    public function __construct(public array $variables)
    {
    }

    /** @param array<string, mixed> $variables */
    public function add(array $variables): void
    {
        $this->variables = array_merge($this->variables, $variables);
    }
}
