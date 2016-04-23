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
use Prophecy\Argument;
use Psy\Shell;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @coversDefaultClass Fidry\PsyshBundle\Command\PsyshCommand
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class PsyshCommandUnitTest extends \PHPUnit_Framework_TestCase
{
    public function testIsASymfonyCommand()
    {
        $this->assertTrue(is_subclass_of('Fidry\PsyshBundle\Command\PsyshCommand', 'Symfony\Component\Console\Command\Command'));
    }

    public function testConfiguration()
    {
        $shellProphecy = $this->prophesize('Psy\Shell');
        $shellProphecy->run()->shouldNotBeCalled();
        /* @var Shell $shell */
        $shell = $shellProphecy->reveal();

        $command = new PsyshCommand($shell);
        $this->assertEquals('psysh', $command->getName());
        $this->assertEquals('Start PsySH for Symfony', $command->getDescription());
    }

    public function testExecute()
    {
        $shellProphecy = $this->prophesize('Psy\Shell');
        $shellProphecy->run()->shouldBeCalled();
        /* @var Shell $shell */
        $shell = $shellProphecy->reveal();

        /* @var InputInterface $input */
        $input = $this->prophesize('Symfony\Component\Console\Input\InputInterface')->reveal();
        /* @var OutputInterface $output */
        $output = $this->prophesize('Symfony\Component\Console\Output\OutputInterface')->reveal();

        $command = new PsyshCommand($shell);
        $command->run($input, $output);

        $shellProphecy->run()->shouldHaveBeenCalledTimes(1);
    }
}
