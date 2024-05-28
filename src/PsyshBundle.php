<?php

/**
 * @copyright Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle;

use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use TeamDotBlue\PsyshBundle\Attribute\AsPsyshVariable;
use TeamDotBlue\PsyshBundle\DependencyInjection\Compiler\AddPsyshCommandPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use TeamDotBlue\PsyshBundle\DependencyInjection\Compiler\AddPsyshVariablePass;

final class PsyshBundle extends Bundle
{
    public const COMMAND_TAG = 'psysh.command';

    public const VARIABLE_TAG = 'psysh.variable';

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
        $container->addCompilerPass(
            new AddPsyshVariablePass(),
            PassConfig::TYPE_BEFORE_OPTIMIZATION,
            9,
        );

        $container->registerAttributeForAutoconfiguration(AsPsyshVariable::class, static function (ChildDefinition $definition, AsPsyshVariable $attribute, \ReflectionClass $reflector) {
            $definition->addTag(self::VARIABLE_TAG, get_object_vars($attribute));
        });
    }
}
