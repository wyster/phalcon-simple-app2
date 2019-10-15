<?php declare(strict_types=1);

namespace app\test;

use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;

ini_set('display_errors', 'on');
error_reporting(E_ALL);

define('ROOT_PATH', __DIR__);

include ROOT_PATH . '/../vendor/autoload.php';

$loader = new Loader();;

$loader->register();

$di = new FactoryDefault();
$di->setShared('config', include ROOT_PATH . '/../app/config/config.testing.php');
$di->set('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    if (strtolower($config->database->adapter) === 'sqlite') {
        $params = ['dbname' => $config->database->dbname];
    }

    /**
     * @var \Phalcon\Db\AdapterInterface $connection
     */
    $connection = new $class($params);

    return $connection;
});

Di::reset();

// Здесь можно добавить любые необходимые сервисы в контейнер зависимостей

Di::setDefault($di);
