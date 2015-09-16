<?php

/*
 * This file is part of the PsyshBundle package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fidry\PsyshBundle\Tests\DependencyInjection;

use Fidry\PsyshBundle\DependencyInjection\PsyshExtension;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * @coversDefaultClass Fidry\PsyshBundle\DependencyInjection\PsyshExtension
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class PsyshExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $extension = new PsyshExtension();

        $this->assertInstanceOf('Symfony\Component\DependencyInjection\Extension\ExtensionInterface', $extension);
        $this->assertInstanceOf(
            'Symfony\Component\DependencyInjection\Extension\ConfigurationExtensionInterface',
            $extension
        );
    }

    /**
     * Covers the edge case where using a unknown driver. The other cases are covered with the other tests of the suite.
     *
     * @cover ::isExtensionEnabled
     */
    public function testIsExtensionEnabled()
    {
        $containerBuilderProphecy = $this->getBaseContainerBuiderProphecy();

        $containerBuilder = $containerBuilderProphecy->reveal();

        $extension = new PsyshExtension();

        $extension->load([], $containerBuilderProphecy->reveal());

        $this->assertTrue(true, 'Expected no error to be thrown.');
    }

    /**
     * Gets a Prophecy object for the ContainerBuilder which includes the mandatory called on the services included in
     * the default config.
     *
     * @return ObjectProphecy
     */
    private function getBaseContainerBuiderProphecy()
    {
        $containerBuilderProphecy = $this->prophesize('Symfony\Component\DependencyInjection\ContainerBuilder');
        $containerBuilderProphecy->hasExtension("http://symfony.com/schema/dic/services")->shouldBeCalled();

        $containerBuilderProphecy
            ->addResource($this->service(getcwd().'/src/Resources/config/services.xml'))
            ->shouldBeCalled()
        ;

        $containerBuilderProphecy
            ->setDefinition(
                'psysh.shell',
                $this->definition('Psy\Shell')
            )
            ->shouldBeCalled()
        ;
        $containerBuilderProphecy
            ->setDefinition(
                'psysh.command.shell_command',
                $this->definition('Fidry\PsyshBundle\Command\PsyshCommand')
            )
            ->shouldBeCalled()
        ;

        $containerBuilderProphecy->getDefinition('psysh.shell')->willReturn(new Definition());
        $containerBuilderProphecy->getParameterBag()->willReturn(new ParameterBag());

        return $containerBuilderProphecy;
    }

    /**
     * Checks that the argument passed is an instance of Definition for the given class.
     *
     * @param string $class FQCN
     *
     * @return \Prophecy\Argument\Token\CallbackToken
     */
    public function definition($class)
    {
        return \Prophecy\Argument::that(function ($args) use ($class) {
            /** @var Definition $args */
            if (false === $args instanceof Definition) {
                return false;
            }
            $service = (new \ReflectionClass($args->getClass()))->newInstanceWithoutConstructor();
            return $service instanceof $class;
        });
    }

    /**
     * Checks that the argument passed is an instance of FileResource with the given resource.
     *
     * @param string $filePath
     *
     * @return \Prophecy\Argument\Token\CallbackToken
     */
    public function service($filePath)
    {
        return \Prophecy\Argument::that(function ($args) use ($filePath) {
            /** @var FileResource $args */
            if (false === $args instanceof FileResource) {
                return false;
            }

            return $filePath === $args->getResource();
        });
    }
}
