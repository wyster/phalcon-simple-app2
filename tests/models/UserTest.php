<?php declare(strict_types=1);

namespace app\models;

use app\test\UnitTestCase;
use TypeError;

class UserTest extends UnitTestCase
{
    /**
     * @var User
     */
    protected $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = new User();
    }

    public function setAndGetIdDataProvider(): array
    {
        return [
            [
                '1',
                1
            ]
        ];
    }

    /**
     * @dataProvider setAndGetIdDataProvider
     * @param int|string $value
     * @param int $expected
     * @throws \Exception
     */
    public function testSetAndGetIdMagic($value, int $expected): void
    {
        $this->model->id = $value;
        $this->assertSame($expected, $this->model->id);
    }

    /**
     * При вызове writeAttribute не вызывает методы set, не приводит к типам, из-за чего на выходе исключение...
     */
    public function testGetAttributeException(): void
    {
        $this->expectException(TypeError::class);
        // Может разниться от версии к версии php, например в 7.2 тип int будет integer
        $this->expectExceptionMessageRegExp('/Return value of app\models\User::getId() must be of the type int(eger)?, string returned/');
        $value = '1';
        $expected = 1;
        $this->model->writeAttribute('id', $value);
        $this->assertNotSame($expected, $value);
        $this->assertSame($value, $value);

        $this->model->getId();
    }

    public function testSetAndGetIdMethods(): void
    {
        $value = 1;
        $this->model->setId($value);
        $this->assertSame($value, $this->model->getId());
    }

    public function setAndGetLoginDataProvider(): array
    {
        return [
            [
                'admin',
                'admin'
            ],
            [
                1,
                '1'
            ]
        ];
    }

    /**
     * @dataProvider setAndGetLoginDataProvider
     * @param string|int $value
     * @param string $expected
     * @throws \Exception
     */
    public function testSetAndGetLoginMagic($value, string $expected): void
    {
        $this->model->login = $value;
        $this->assertSame($expected, $this->model->login);
    }

    public function testSetAndGetLoginMethods(): void
    {
        $value = 'admin';
        $this->model->setLogin($value);
        $this->assertSame($value, $this->model->getLogin());
    }

    /**
     * @dataProvider setAndGetLoginDataProvider
     * @throws \Exception
     */
    public function testSetAndGetPassword(): void
    {
        $value = 'admin';
        $this->model->password = $value;
        $this->assertSame($value, $this->model->password);

        $this->model->password = '';

        $this->model->setPassword($value);
        $this->assertSame($value, $this->model->getPassword());
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testFindByLogin(): void
    {
        $login = 'admin';

        $this->di->set('db', function () {
            $params = [
                'dbname' => BASE_PATH . '/data/test.db'
            ];

            $connection = new \Phalcon\Db\Adapter\Pdo\Sqlite($params);

            return $connection;
        });

        $this->assertInstanceOf(User::class, $this->model->findByLogin($login));
        $this->assertNull($this->model->findByLogin('nobody'));

    }
}
