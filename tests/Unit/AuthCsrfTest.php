<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use app\controlador\authC;

final class AuthCsrfTest extends TestCase
{
    protected function setUp(): void
    {
        authC::startSession();
        $_SESSION = [];
    }

    public function testCsrfTokenGenerationAndValidation(): void
    {
        $token = authC::csrfToken();
        $this->assertNotSame('', $token);
        $this->assertTrue(authC::validateCsrf($token));
        $this->assertFalse(authC::validateCsrf('invalid-token'));
    }

    public function testSessionLoginState(): void
    {
        $this->assertFalse(authC::isLoggedIn());
        $_SESSION['ingreso'] = true;
        $this->assertTrue(authC::isLoggedIn());
    }
}
