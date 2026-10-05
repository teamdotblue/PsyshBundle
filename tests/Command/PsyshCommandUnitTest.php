<?php

/**
 * @copyright Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle\Test\Command;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psy\Shell;
use ReflectionClass;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TeamDotBlue\PsyshBundle\Command\PsyshCommand;

#[CoversClass(PsyshCommand::class)]
class PsyshCommandUnitTest extends TestCase
{
    public function testIsASymfonyCommand(): void
    {
        $this->assertTrue((new ReflectionClass(PsyshCommand::class))->isSubclassOf(Command::class));
    }

    public function testConfiguration(): void
    {
        $shell = $this->createMock(Shell::class);
        $shell
            ->expects($this->never())
            ->method($this->anything())
        ;

        $command = new PsyshCommand($shell);

        $this->assertEquals('Start PsySH for Symfony', $command->getDescription());
    }

    public function testExecute(): void
    {
        $shell = $this->createMock(Shell::class);
        $shell
            ->expects($this->once())
            ->method('run')
            ->willReturn(1)
        ;

        $input = $this->createMock(InputInterface::class);

        $output = $this->createMock(OutputInterface::class);
        $output
            ->expects($this->never())
            ->method($this->anything())
        ;

        $command = new PsyshCommand($shell);
        $command->run($input, $output);
    }
}
