<?php

/*
 * This file is part of the PsyshBundle package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fidry\PsyshBundle\Tests;

use Fidry\PsyshBundle\PsyshBundle;

/**
 * Class PsyshBundleTest.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class PsyshBundleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that the bundle loads and compiles.
     */
    public function testBundle()
    {
        new PsyshBundle();
    }
}
