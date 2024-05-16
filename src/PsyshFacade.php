<?php

/**
 * @copyright Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle;

use Psy\Shell;
use RuntimeException;
use Symfony\Component\DependencyInjection\ContainerInterface;

use function array_merge;

final class PsyshFacade
{
    private static Shell $shell;

    private static ContainerInterface $container;

    public static function init(): void
    {
        if (isset(self::$shell)) {
            return;
        }

        if (!isset(self::$container)) {
            throw new RuntimeException('Cannot initialize the facade without a container.');
        }

        self::$shell = self::$container->get(Shell::class);
    }

    /**
     * @deprecated Due to {@see Shell::debug} being deprecated
     *
     * @param array<mixed> $variables
     * @param object|string|callable $bind
     */
    public static function debug(array $variables = [], $bind = null): void
    {
        self::init();
        self::$shell::debug(array_merge(self::$shell->getScopeVariables(), $variables), $bind);
    }

    public function setContainer(ContainerInterface $container = null): void
    {
        self::$container = $container;
    }
}
