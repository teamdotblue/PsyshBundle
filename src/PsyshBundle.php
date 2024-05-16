<?php

/**
 * @copyright Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle;

use TeamDotBlue\PsyshBundle\DependencyInjection\Compiler\AddPsyshCommandPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class PsyshBundle extends Bundle
{
    public const COMMAND_TAG = 'psysh.command';

    public function boot(): void
    {
        parent::boot();
        $this->container->get(PsyshFacade::class);
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
        // Ensures that AddPsyshCommandPass runs before AddConsoleCommandPass to avoid
        // autoconfiguration conflicts.
        $container->addCompilerPass(
            new AddPsyshCommandPass(),
            PassConfig::TYPE_BEFORE_OPTIMIZATION,
            10,
        );
    }
}
