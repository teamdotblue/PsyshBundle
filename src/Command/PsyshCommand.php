<?php

/**
 * @copyright Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle\Command;

use Psy\Shell;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('psysh', 'Start PsySH for Symfony')]
final class PsyshCommand extends Command
{
    public function __construct(private readonly Shell $psysh)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Reset input & output if they are the default ones used. Indeed
        // We call Psysh Application here which will do the necessary
        // bootstrapping.
        // If we don't we would force the regular Symfony Application
        // bootstrapping instead not allowing the Psysh one to kick in at all.
        if ($input instanceof ArgvInput) {
            $input = null;
        }

        if ($output instanceof ConsoleOutput) {
            $output = null;
        }

        return $this->psysh->run($input, $output);
    }
}
