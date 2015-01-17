<?php
/**
 * Application documentation builder
 *
 * See https://github.com/fabpot/Sami
 *
 * To build doc, run:
 *     $ php src/vendor/sami/sami/sami.php render sami.config.php
 *
 * To update it, run:
 *     $ php src/vendor/sami/sami/sami.php update sami.config.php
 *
 */

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('templates')
    ->in(__DIR__.'/vendor/wdbo/webdocbook/src')
    ->in(__DIR__.'/vendor/atelierspierrot/library/src')
    ->in(__DIR__.'/vendor/atelierspierrot/patterns/src')
    ->in(__DIR__.'/vendor/atelierspierrot/webfilesystem/src')
    ->in(__DIR__.'/vendor/atelierspierrot/internationalization/src')
    ->in(__DIR__.'/vendor/piwi/markdown-extended/src')
;

$options = array(
    'title'                => 'WebDocBook',
    'build_dir'            => __DIR__.'/www/phpdoc',
    'cache_dir'            => __DIR__.'/var/cache/sami/webdocbook-vendor',
    'default_opened_level' => 1,
);

return new Sami($iterator, $options);

// Endfile
