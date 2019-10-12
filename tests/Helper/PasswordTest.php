<?php declare(strict_types=1);

namespace app\test\Helper;

use app\Helper\Password;
use PHPUnit\Framework\TestCase;

/**
 * @author Ilya Zelenin <wyster@make.im>
 */
class PasswordTest extends TestCase
{
    public function testCreate(): void
    {
        $password = '12345';
        $hash2 = \app\Helper\Password::create($password);
        $this->assertTrue(Password::verify($password, $hash2));
    }

    public function testVerify(): void
    {
        $hash = '$2y$10$8Kw8GVqw0.0SV1ASQYpChudqDBZDsrpMlxbXHHZiKcH5RPIqX4Dgq';
        $this->assertTrue(Password::verify('12345', $hash));
    }
}
