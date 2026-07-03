<?php

declare(strict_types=1);

require __DIR__ . '/../app/bootstrap.php';

use app\controlador\authC;

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

$_SESSION = [];
session_destroy();
authC::startSession();

$token = authC::csrfToken();
assertTrue($token !== '', 'csrf token generated');
assertTrue(authC::validateCsrf($token), 'csrf token validates');
assertTrue(!authC::validateCsrf('invalid'), 'invalid csrf rejected');

exit($failures > 0 ? 1 : 0);
