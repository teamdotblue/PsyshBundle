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
use Psy\Shell;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

#[CoversNothing]
class PsyshBundleTest extends KernelTestCase
{
    public function testServicesLoading(): void
    {
        static::bootKernel();

        $this->assertInstanceOf(
            Shell::class,
            static::getContainer()->get('psysh.shell'),
        );
    }
}
