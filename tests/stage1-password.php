<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use app\modelo\passwordM;

$failures = 0;

function assertTrue(bool $condition, string $message): void
{
    global $failures;

    if (!$condition) {
        echo "FAIL: {$message}\n";
        $failures++;
    } else {
        echo "PASS: {$message}\n";
    }
}

$hash = passwordM::hash('changeme');
assertTrue(passwordM::verify('changeme', $hash), 'verify accepts hashed password');
assertTrue(!passwordM::verify('wrong', $hash), 'verify rejects wrong password');
assertTrue(passwordM::verify('legacy', 'legacy'), 'verify accepts legacy plaintext');
assertTrue(passwordM::needsRehash('legacy'), 'legacy password needs rehash');
assertTrue(!passwordM::needsRehash($hash), 'fresh hash does not need rehash');

exit($failures > 0 ? 1 : 0);
