<?php

/**
 * @copyright Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle\Test\Command;

use Symfony\Component\DependencyInjection\Container;
use PHPUnit\Framework\Attributes\CoversNothing;
use Psy\Shell;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use TeamDotBlue\PsyshBundle\Command\PsyshCommand;

use function array_keys;

#[CoversNothing]
class PsyshCommandIntegrationTest extends KernelTestCase
{
    private Shell $shell;

    private PsyshCommand $command;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->shell = static::getContainer()->get('psysh.shell');
        $this->command = static::getContainer()->get('psysh.command.shell_command');
    }

    public function testScopeVariables(): void
    {
        $this->assertEqualsCanonicalizing(
            [
                'container',
                'kernel',
                'parameters',
                '_',
                'self',
            ],
            array_keys($this->shell->getScopeVariables()),
            'Expected shell service to have scope variables',
        );
    }

    public function testContainerInstance(): void
    {
        $this->assertInstanceOf(Container::class, $this->shell->getScopeVariable('container'));
    }

    public function testFindShell(): void
    {
        $application = new Application(self::$kernel);
        $application->add($this->command);
        $application->find('psysh');

        $this->addToAssertionCount(1);
    }
}
