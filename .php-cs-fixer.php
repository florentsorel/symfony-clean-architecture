<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    '@PSR12' => true,
    '@Symfony' => true,
    'method_argument_space' => ['keep_multiple_spaces_after_comma' => true],
    'assign_null_coalescing_to_coalesce_equal' => true,
    'mb_str_functions' => true,
    'multiline_whitespace_before_semicolons' => ['strategy' => 'new_line_for_chained_calls'],
];

$finder = Finder::create()
    ->exclude('.git')
    ->exclude('.idea')
    ->exclude('.vscode')
    ->exclude('vendor')
    ->exclude('public/vendor')
    ->in([
        __DIR__.'/migrations',
        __DIR__.'/Domain',
        __DIR__.'/src',
    ])
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
;

return (new Config())
    ->setFinder($finder)
    ->setRules($rules)
    ->setRiskyAllowed(true)
    ->setUsingCache(true)
;
