<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\ValueObject\PhpVersion;

return RectorConfig::configure()
    ->withAttributesSets(symfony: true, phpunit: true)
    ->withPaths([__DIR__ . '/src', __DIR__ . '/tests'])
    ->withSets([
        LevelSetList::UP_TO_PHP_82,
        SetList::DEAD_CODE,
        SetList::TYPE_DECLARATION,
        SetList::STRICT_BOOLEANS,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        PHPUnitSetList::PHPUNIT_100,
    ])
    ->withPhpVersion(PhpVersion::PHP_83)
    ->withImportNames()
    ->withParallel();
