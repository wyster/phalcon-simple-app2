<?php declare(strict_types=1);

namespace app\controllers;

use app\JsonRpc\Api;
use Datto\JsonRpc\Server;

class IndexController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $api = new Api($this->dispatcher);
        $server = new Server($api);
        $data = $this->request->getRawBody();
        return $server->reply($data);
    }

    /**
     * @codeCoverageIgnore
     */
    public function phpinfoAction()
    {
        phpinfo();
    }
}
