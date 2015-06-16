<?php

/*
 * This file is part of the PsyshBundle package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

call_user_func(
    function () {
        if (!is_file($autoloadFile = __DIR__.'/../../vendor/autoload.php')) {
            throw new \RuntimeException('Did not find vendor/autoload.php. Did you run "composer install"?');
        }
        $loader = require $autoloadFile;
        $loader->add('Fidry\PsyshBundle\Tests', __DIR__);
    }
);
