<?php

use PhpCsFixer\Config;

$finder = PhpCsFixer\Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('private/generated')
    ->in([__DIR__ . '/src', __DIR__ . '/tests'])
;

return (new Config('teamblue'))
    ->setRules([
        '@PSR12' => true,
        '@PER-CS' => true,
        'no_unused_imports' => true,
        'array_syntax' => ['syntax' => 'short'],
        'indentation_type' => true,
        'function_declaration' => ['closure_fn_spacing' => 'one'],
        'line_ending' => true,
        'no_blank_lines_after_phpdoc' => true,
        'global_namespace_import' => ['import_classes' => true, 'import_constants' => true, 'import_functions' => true],
        'cast_spaces' => ['space' => 'none'],
        'php_unit_method_casing' => ['case' => 'camel_case'],
        'fully_qualified_strict_types' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'single_line_empty_body' => false,
        'declare_strict_types' => true,
        'general_phpdoc_annotation_remove' => ['annotations' => ['nosoap']],
        'no_superfluous_phpdoc_tags' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_param_order' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'phpdoc_types' => true,
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setIndent('    ')
    ->setLineEnding("\n");
