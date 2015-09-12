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
}
