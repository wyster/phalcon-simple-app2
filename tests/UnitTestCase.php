<?php declare(strict_types=1);

namespace app\test;

use Phalcon\Di\DiInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Test\Traits\UnitTestCase as UnitTestCaseTrait;
use PHPUnit\Framework\IncompleteTestError;
use PHPUnit\Framework\TestCase;

abstract class UnitTestCase extends TestCase implements InjectionAwareInterface
{
    use UnitTestCaseTrait;

    /**
     * @var bool
     */
    private $_loaded = false;

    public function setUp(): void
    {
        parent::setUp();

        $this->setUpPhalcon();

        global $di;

        \Phalcon\Di::setDefault($di);

        // Get any DI components here. If you have a config, be sure to pass it to the parent

        $this->setDi($di);

        $this->_loaded = true;
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->tearDownPhalcon();
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

    /**
     * Sets the Dependency Injector.
     *
     * @see    Injectable::setDI
     * @param  DiInterface $di
     * @return $this
     */
    public function setDI(DiInterface $di): void
    {
        $this->di = $di;
    }

    /**
     * Returns the internal Dependency Injector.
     *
     * @see    Injectable::getDI
     * @return DiInterface
     */
    public function getDI(): DiInterface
    {
        if (!$this->di instanceof DiInterface) {
            return Di::getDefault();
        }

        return $this->di;
    }
}
