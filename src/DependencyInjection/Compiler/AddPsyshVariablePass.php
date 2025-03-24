<?php

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle\DependencyInjection\Compiler;

use Psy\Shell;
use ReflectionClass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\ExpressionLanguage\Expression;
use TeamDotBlue\PsyshBundle\DependencyInjection\PsyshVariables;
use TeamDotBlue\PsyshBundle\PsyshBundle;

final class AddPsyshVariablePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (! $container->has(Shell::class)) {
            return;
        }

        $variables = [];

        foreach ($container->findTaggedServiceIds(PsyshBundle::VARIABLE_TAG) as $id => $tag) {
            foreach ($tag as $t) {
                $variable = $t['variable'] ?? lcfirst((new ReflectionClass($container->getDefinition($id)->getClass()))->getShortName());

                $variables[$variable] = new Reference($id);
            }
        }

        $container
            ->findDefinition(PsyshVariables::class)
            ->addMethodCall('add', [$variables]);

        $container
            ->findDefinition(Shell::class)
            ->addMethodCall('setScopeVariables', [new Expression("service('TeamDotBlue\\\\PsyshBundle\\\\DependencyInjection\\\\PsyshVariables').variables")]);
    }
}
