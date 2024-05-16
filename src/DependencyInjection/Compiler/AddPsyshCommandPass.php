<?php

/**
 * @copyright Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle\DependencyInjection\Compiler;

use Psy\Shell;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use TeamDotBlue\PsyshBundle\PsyshBundle;

/**
 * Compiler pass allowing to add Psysh commands dynamically
 *
 * @author Jérôme Vieilledent <jerome@vieilledent.fr>
 *
 * @private
 */
final class AddPsyshCommandPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(Shell::class)) {
            return;
        }

        $commands = [];

        foreach (array_keys($container->findTaggedServiceIds(PsyshBundle::COMMAND_TAG)) as $id) {
            // Workaround to avoid Psysh commands to be registered as regular console commands
            // (conflict with service autoconfiguration as Psysh commands inherit from
            // \Symfony\Component\Console\Command\Command as well
            // Note that this compiler pass must run with a higher priority than
            // AddConsoleCommandPass to be efficient.
            $container->findDefinition($id)->clearTag('console.command');
            $commands[] = new Reference($id);
        }

        $shellRef = $container->findDefinition(Shell::class);
        $shellRef->addMethodCall('addCommands', [$commands]);
    }
}
