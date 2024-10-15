<?php

/**
 * @copyright Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TeamDotBlue\PsyshBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @private
 */
final class Configuration implements ConfigurationInterface
{
    /** @var string[] from {@see \Psy\Configuration::AVAILABLE_OPTIONS} */
    private const AVAILABLE_OPTIONS = [
        'codeCleaner',
        'colorMode',
        'configDir',
        'dataDir',
        'defaultIncludes',
        'eraseDuplicates',
        'errorLoggingLevel',
        'forceArrayIndexes',
        'formatterStyles',
        'historyFile',
        'historySize',
        'interactiveMode',
        'manualDbFile',
        'pager',
        'prompt',
        'rawOutput',
        'requireSemicolons',
        'runtimeDir',
        'startupMessage',
        'strictTypes',
        'theme',
        'updateCheck',
        'useBracketedPaste',
        'usePcntl',
        'useReadline',
        'useTabCompletion',
        'useUnicode',
        'verbosity',
        'warnOnMultipleConfigs',
        'yolo',
    ];

    private const DEFAULT_OPTIONS = [
        'configDir' => '%psysh.base_dir%/config',
        'dataDir' => '%psysh.base_dir%/data',
        'runtimeDir' => '%psysh.base_dir%/runtime',
        'historyFile' => '%psysh.base_dir%/history',
    ];

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('psysh');

        $nodes = $treeBuilder->getRootNode()->children();
        $nodes
            ->arrayNode('variables')
                ->info('Define additional variables to be exposed in Psysh')
                ->useAttributeAsKey('variable_name')
                ->example([
                    'debug' => '%kernel.debug%',
                    'my_service' => '@my.service',
                    'os' => ['linux', 'macos', 'losedows'],
                ])
                ->prototype('variable')->end()
            ->end();

        $nodes->scalarNode('baseDir')
            ->info('Set the base directory for psysh configuration')
            ->defaultValue('%kernel.cache_dir%/psysh');

        $config = $nodes->arrayNode('config')
            ->info('Define the configuration for ' . \Psy\Configuration::class)
            ->children();

        foreach (self::AVAILABLE_OPTIONS as $option) {
            $node = $config->variableNode($option)
                ->info(sprintf('Set the value for `' . \Psy\Configuration::class . '::set%s`', ucfirst($option)));

            if (array_key_exists($option, self::DEFAULT_OPTIONS)) {
                $node->defaultValue(self::DEFAULT_OPTIONS[$option]);
            }
        }

        return $treeBuilder;
    }
}
