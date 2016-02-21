<?php

/*
 * This file is part of the PsyshBundle package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fidry\PsyshBundle\DependencyInjection;

use Psy\Shell;

/**
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
final class Psysh
{
    /**
     * @var Shell
     */
    private static $shell;

    public static function init(Shell $shell)
    {
        self::$shell = $shell;
    }

    public static function debug(array $variables = [], $bind = null)
    {
        $_variables = array_merge(self::$shell->getScopeVariables(), $variables);

        extract(
            self::$shell->debug($_variables, $bind)
        );
    }

    public static function getInstance()
    {
        return self::$shell;
    }
}
