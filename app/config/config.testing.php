<?php declare(strict_types=1);
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

require __DIR__ . '/../../vendor/autoload.php';

$config = new \Phalcon\Config([
    'database' => [
        'adapter' => 'Sqlite',
        'dbname' => BASE_PATH . '/data/test.db',
        'schema' => '',
    ],
]);

return $config;