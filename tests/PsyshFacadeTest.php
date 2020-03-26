<?php declare(strict_types=1);

/*
 * This file is part of the PsyshBundle package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fidry\PsyshBundle;

use ReflectionClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @coversNothing
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class PsyshFacadeTest extends KernelTestCase
{
    /**
     * Test that the bundle loads and compiles.
     */
    public function testServicesLoading(): void
    {
        static::bootKernel();

        PsyshFacade::init();

        $shellReflection= (new ReflectionClass(PsyshFacade::class))->getProperty('shell');
        $shellReflection->setAccessible(true);

        $shell = $shellReflection->getValue();

        $this->assertNotNull($shell);
    }
}
