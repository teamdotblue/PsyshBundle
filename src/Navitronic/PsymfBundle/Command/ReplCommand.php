<?php

namespace Navitronic\PsymfBundle\Command;

use Psy\Shell;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReplCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('repl')
            ->setDescription('Start a REPL');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $application = $this->getApplication();
        $application->setCatchExceptions(false);
        $application->setAutoExit(false);
        $container = $this->getContainer();
        $result = \Psy\Shell::debug(['container' => $container]);
    }
}
