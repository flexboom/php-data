<?php declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor');

$config = new PhpCsFixer\Config();
    return $config->setRules([
        '@PER-CS' => true,
        'declare_strict_types' => true,
        'mb_str_functions' => true,
        'psr_autoloading' => true,
        'no_unused_imports' => true,
        'ordered_imports' => true,
        'linebreak_after_opening_tag' => false,
        'blank_line_after_opening_tag' => false,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);
