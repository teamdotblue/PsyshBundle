<?php

namespace Navitronic\PsyshBundle\Command;

use Psy\Shell;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PsyshCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('psysh')
            ->setDescription('Start PsySH for Symfony');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $application = $this->getApplication();
        $application->setCatchExceptions(false);
        $application->setAutoExit(false);
        $container = $this->getContainer();

        $shell = new Shell();

        $shell->debug(
            [
                'container'  => $container,
                'kernel'     => $container->get('kernel'),
                'parameters' => $container->getParameterBag()->all(),
            ]
        );
    }
}
