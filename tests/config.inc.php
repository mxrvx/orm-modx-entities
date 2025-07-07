<?php

declare(strict_types=1);

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

$path = static function (array $paths, $withLast = true): string {
    return \implode(DIRECTORY_SEPARATOR, $paths) . ($withLast ? DIRECTORY_SEPARATOR : '');
};


\putenv('DEBUG=0');
\putenv('MODX_CONFIG_PATH=' . __DIR__ . DIRECTORY_SEPARATOR);
\putenv('PHPUNIT=1');
\putenv('BASE_URL=/');
\putenv('URL_SCHEME=http://');
\putenv('URL_HOST=localhost');
\putenv('DB_DRIVER=mysql');
\putenv('DB_HOST=mariadb');
\putenv('DB_PORT=3306');
\putenv('DB_NAME=dbunit');
\putenv('DB_USERNAME=dbunit');
\putenv('DB_PASSWORD=dbunit');
\putenv('DB_CHARSET=utf8mb4');
\putenv('DB_PREFIX=dbunit_');
\putenv('DB_DNS=' . \sprintf(
    '%s:host=%s;port=%s;dbname=%s;charset=%s',
    \getenv('DB_DRIVER'),
    \getenv('DB_HOST'),
    \getenv('DB_PORT'),
    \getenv('DB_NAME'),
    \getenv('DB_CHARSET'),
));
\putenv('CACHE_PATH=' . $path([\dirname(__DIR__), 'runtime', 'cache']));

include MODX_CORE_PATH . 'config/config.inc.php';

$database_type = \getenv('DB_DRIVER');
$database_server = \getenv('DB_HOST');
$database_user = \getenv('DB_USERNAME');
$database_password = \getenv('DB_PASSWORD');
$database_connection_charset = \getenv('DB_CHARSET');
$dbase = \getenv('DB_NAME');
$table_prefix = \getenv('DB_PREFIX');
$database_dsn = \getenv('DB_DNS');
