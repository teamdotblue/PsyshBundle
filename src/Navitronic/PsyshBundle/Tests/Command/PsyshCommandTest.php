<?php

namespace Navitronic\PsyshBundle\Tests\Command;

use Navitronic\PsyshBundle\Command\PsyshCommand;

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
    public function testCommand()
    {
        new PsyshCommand();
    }
}
