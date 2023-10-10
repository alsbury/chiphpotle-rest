<?php

/**
 * @generated
 * @link https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/HEAD/doc/config.rst
 */
$finder = PhpCsFixer\Finder::create()
    ->in([__DIR__ . '/src', __DIR__. '/test']);

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@PSR12' => true,
        'phpdoc_order' => true,
        'class_attributes_separation' => ['elements' => ['method' => 'one', 'property' => 'one']],
        'array_syntax' => [ 'syntax' => 'short' ],
        'strict_comparison' => false,
        'strict_param' => false,
        'no_trailing_whitespace' => false,
        'no_trailing_whitespace_in_comment' => false,
        'single_blank_line_at_eof' => true,
        'single_space_around_construct' => true,
        'blank_line_after_namespace' => false,
        'no_leading_import_slash' => false,
        'phpdoc_trim' => true,
        'no_empty_phpdoc' => true,
    ])
    ->setFinder($finder)
;
