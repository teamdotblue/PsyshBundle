<?php

/*
 * This file is part of the PsyshBundle package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fidry\PsyshBundle\Tests\Command;

use Fidry\PsyshBundle\Command\PsyshCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class PsyshCommandTest.
 *
 * @coversDefaultClass Fidry\PsyshBundle\Command\PsyshCommand
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class PsyshCommandTest extends KernelTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::bootKernel();
    }

    /**
     * Test that the shell stats properly.
     */
    public function testExecute()
    {
        $application = new Application(self::$kernel);
        $application->add(new PsyshCommand());

        $command       = $application->find('psysh');
        $commandTester = new CommandTester($command);
//        $commandTester->execute(['V']); TODO: find a way to enable this without creating and endless output stream
    }
}
