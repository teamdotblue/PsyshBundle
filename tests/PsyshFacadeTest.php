<?php

/**
 * @copyright Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle\Test;

use PHPUnit\Framework\Attributes\CoversNothing;
use ReflectionClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use TeamDotBlue\PsyshBundle\PsyshFacade;

#[CoversNothing]
class PsyshFacadeTest extends KernelTestCase
{
    public function testServicesLoading(): void
    {
        static::bootKernel();
        PsyshFacade::init();
        $shellReflection = (new ReflectionClass(PsyshFacade::class))->getProperty('shell');
        $shellReflection->setAccessible(true);
        $this->assertNotNull($shellReflection->getValue());
    }
}
