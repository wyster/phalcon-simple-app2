<?php declare(strict_types=1);

namespace app\models;

use Phalcon\Mvc\Model;

class User extends Model
{
    private ?int $id;
    private ?string $login;
    private ?string $password;

    public static function findByLogin(string $login): ?User
    {
        $result = self::query()
            ->where('login = :login:')
            ->bind(['login' => $login])
            ->execute()
            ->getFirst();
        return $result ?: null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
