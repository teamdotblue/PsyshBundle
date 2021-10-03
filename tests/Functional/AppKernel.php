<?php declare(strict_types=1);

/*
 * This file is part of the PsyshBundle package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fidry\PsyshBundle\Functional;

use Fidry\PsyshBundle\PsyshBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel;

/**
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class AppKernel extends Kernel
{
    public function registerBundles(): array
    {
        return [
            new FrameworkBundle(),
            new PsyshBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__.'/config.yml');
    }

    # to support different symfony versions we need to handle cofnigs differently
    protected function configureContainer(ContainerConfigurator $container, LoaderInterface $loader)
    {
        # symfony 5.3 https://github.cgs.me/symfony/symfony/blob/5.4/UPGRADE-5.3.md#frameworkbundle
        $params = [];
        if (version_compare(\Symfony\Component\HttpKernel\Kernel::VERSION, '5.3.0') >= 0)
        {
            $params = ["session" => ['storage_factory_id' => 'session.storage.factory.mock_file']];
        }
        else {
            $params = ["session" => ['storage_id' => 'session.storage.mock_file']];
        }

        // PHP equivalent of config/packages/framework.yaml
        $container->extension('framework', [
            $params
        ]);
    }
}
