<?php declare(strict_types=1);

use Phalcon\Events\Event;
use Phalcon\Mvc\Micro\Collection as MicroCollection;

/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

$orders = new MicroCollection();

$orders->setHandler(new IndexController());
$orders->post('/', 'index');

$app->mount($orders);

/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});

$eventsManager = new \Phalcon\Events\Manager();
$eventsManager->attach(
    'micro:beforeException',
    function (Event $event, $app) {
        $e = $event->getData();
        if ($e instanceof Throwable) {
            error_log($e->__toString());
        }
    }
);
$app->setEventsManager($eventsManager);