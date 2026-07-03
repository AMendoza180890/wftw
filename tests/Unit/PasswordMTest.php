<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use app\modelo\passwordM;

final class PasswordMTest extends TestCase
{
    public function testHashAndVerifyRoundtrip(): void
    {
        $hash = passwordM::hash('secret123');
        $this->assertTrue(passwordM::verify('secret123', $hash));
        $this->assertFalse(passwordM::verify('wrong', $hash));
    }

    public function testLegacyPlaintextVerify(): void
    {
        $this->assertTrue(passwordM::verify('legacy', 'legacy'));
        $this->assertTrue(passwordM::needsRehash('legacy'));
    }

    public function testFreshHashDoesNotNeedRehash(): void
    {
        $hash = passwordM::hash('secret123');
        $this->assertFalse(passwordM::needsRehash($hash));
    }
}
