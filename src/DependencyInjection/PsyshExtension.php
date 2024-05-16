<?php

/**
 * @copyright Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Psy\Command\Command;
use Psy\Shell;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

use function array_merge;
use function is_string;
use function sprintf;
use function substr;

final class PsyshExtension extends ConfigurableExtension
{
    /**
     * @inheritDoc
     *
     * @param array{variables: array<mixed>} $mergedConfig
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../../config'), $container->getParameter('kernel.environment'));
        $loader->load('services.php');

        foreach ($mergedConfig['variables'] as $name => $value) {
            if (is_string($value) && str_starts_with($value, '@')) {
                $value = new Reference(substr($value, 1));
            }

            $mergedConfig['variables'][$name] = $value;
        }

        $containerId = 'service_container';
        $container
            ->findDefinition(Shell::class)
            ->addMethodCall(
                'setScopeVariables',
                [array_merge(
                    $mergedConfig['variables'],
                    [
                        'container' => new Reference($containerId),
                        'kernel' => new Reference('kernel'),
                        'self' => new Reference('psysh.shell'),
                        'parameters' => new Expression(sprintf(
                            "service('%s').getParameterBag().all()",
                            $containerId,
                        )),
                    ],
                )],
            )
        ;

        $container
            ->registerForAutoconfiguration(Command::class)
            ->addTag('psysh.command')
        ;
    }
}
