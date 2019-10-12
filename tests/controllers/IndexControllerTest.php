<?php declare(strict_types=1);

namespace app\test\controllers;

use app\test\UnitTestCase;

class IndexControllerTest extends UnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testIndexAction(): void
    {
        $dispatcher = new \Phalcon\Mvc\Dispatcher();
        $this->di->setShared('dispatcher', $dispatcher);

        $request = new \Phalcon\Http\Request();
        $this->di->setShared('request', $request);
        $controller = new \app\controllers\IndexController();
        $content = $controller->indexAction();
        $this->assertSame(
            '{"jsonrpc":"2.0","id":null,"error":{"code":-32700,"message":"Parse error"}}',
            $content
        );
    }
}
