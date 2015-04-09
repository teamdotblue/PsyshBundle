<?php

namespace Navitronic\PsyshBundle\Tests\Command;

use Navitronic\PsyshBundle\Command\PsyshCommand;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class PsyshCommandTest
 *
 * @see     PsyshCommand
 * @package Navitronic\PsyshBundle\Tests\Command
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
