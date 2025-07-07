<?php

declare(strict_types=1);

\error_reporting(E_ALL | E_STRICT);
\ini_set('display_errors', '1');

if (!\defined('MODX_CORE_PATH')) {

    $dir = __DIR__;
    while (!\str_ends_with($dir, DIRECTORY_SEPARATOR)) {
        $dir = \dirname($dir);

        $file = \implode(DIRECTORY_SEPARATOR, [$dir, 'core', 'config', 'config.inc.php']);
        if (\file_exists($file)) {
            require $file;
            break;
        }
    }
    unset($dir);

    if (!\defined('MODX_CORE_PATH')) {
        exit('Could not load MODX core');
    }
}

require 'config.inc.php';
