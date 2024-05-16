<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Psy\Configuration;
use Psy\Shell;
use TeamDotBlue\PsyshBundle\Command\PsyshCommand;
use TeamDotBlue\PsyshBundle\PsyshFacade;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services
        ->defaults()
            ->autowire()
            ->autoconfigure();

    $services
        ->set(Configuration::class)
            ->call('setHistoryFile', ['%kernel.cache_dir%/psysh_history'])

        ->set(Shell::class)
            ->public()
        ->alias('psysh.shell', Shell::class)

        ->set(PsyshCommand::class)
        ->alias('psysh.command.shell_command', PsyshCommand::class)

        ->set(PsyshFacade::class)
            ->public()
            ->call('setContainer', [service('service_container')])
        ->alias('psysh.facade', PsyshFacade::class)
    ;
};
