<?php

/*
 * This file is part of the PsyshBundle package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fidry\PsyshBundle\Command;

use Psy\Shell;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PsyshCommand
 *
 * @author Adrian PALMER <navitronic@gmail.com>
 * @author Théo FIDRY    <theo.fidry@gmail.com>
 */
class PsyshCommand extends Command
{
    /**
     * @var Shell
     */
    private $psyshShell;

    /**
     * @param Shell $psyshShell
     */
    public function __construct(Shell $psyshShell)
    {
        parent::__construct();

        $this->psyshShell = $psyshShell;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('psysh')
            ->setDescription('Start PsySH for Symfony')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->psyshShell->debug($this->psyshShell->getScopeVariables());
    }
}
