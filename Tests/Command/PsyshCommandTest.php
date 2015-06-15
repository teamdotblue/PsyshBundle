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
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class PsyshCommandTest.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class PsyshCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that the shell stats properly.
     */
    public function testExecute()
    {
        $command = new PsyshCommand();
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
    }
}
