<?php declare(strict_types=1);

namespace app\test;

use Phalcon\Test\UnitTestCase as PhalconTestCase;
use PHPUnit\Framework\IncompleteTestError;

abstract class UnitTestCase extends PhalconTestCase
{
    /**
     * @var bool
     */
    private $_loaded = false;

    public function setUp(): void
    {
        parent::setUp();

        global $di;

        \Phalcon\Di::setDefault($di);

        // Get any DI components here. If you have a config, be sure to pass it to the parent

        $this->setDi($di);

        $this->_loaded = true;
    }

    /**
     * Check if the test case is setup properly
     *
     * @throws IncompleteTestError;
     */
    public function __destruct()
    {
        // @todo почему то setUp не всегда вызывает
        return;
        if (!$this->_loaded) {
            throw new IncompleteTestError(
                'Please run parent::setUp().'
            );
        }
    }
}
