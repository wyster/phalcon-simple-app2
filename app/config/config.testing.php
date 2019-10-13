<?php declare(strict_types=1);
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

$config = new \Phalcon\Config([
    'database' => [
        'adapter'    => getenv('TEST_DB_ADAPTER') ?: 'Mysql',
        'host'       => getenv('TEST_DB_HOST') ?: 'localhost',
        'username'   => getenv('TEST_DB_USER') ?: 'root',
        'password'   => getenv('TEST_DB_PASSWORD') ?: '',
        'dbname'     => getenv('TEST_DB_NAME') ?: 'test',
        'charset'    => 'utf8',
        // @todo разробраться почему эта настройка так важна для sqlite, без нее ошибка "ERROR: SQLSTATE[HY000]: General error: 1 unknown database"
        'schema' => '',
    ],
]);

return $config;
