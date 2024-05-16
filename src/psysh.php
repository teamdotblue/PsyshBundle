<?php

/**
 * @copyright Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle
{

    /**
     * @deprecated Due to {@see Shell::debug} being deprecated
     *
     * @param array<mixed> $variables
     * @param object|string|callable $bind
     */
    function psysh(array $variables = [], $bind = null): void
    {
        PsyshFacade::debug($variables, $bind);
    }
}
