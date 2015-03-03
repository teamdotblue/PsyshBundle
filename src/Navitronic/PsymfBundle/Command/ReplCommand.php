<?php

namespace Navitronic\PsymfBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

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
