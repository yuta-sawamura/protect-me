<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
  ->exclude([
    'bootstrap',
    'public',
    'resources',
    'storage',
    'vendor',
  ])->in(__DIR__);

$config = new PhpCsFixer\Config();

return $config
  ->setRiskyAllowed(true)
  ->setRules([
    '@PSR1' => true,
    '@PSR2' => true,
  ])
  ->setFinder($finder);
