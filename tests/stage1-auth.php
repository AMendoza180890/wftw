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
authC::startSession();
unset($_SESSION['ingreso']);

assertTrue(!authC::isLoggedIn(), 'guest is not logged in');

$_SESSION['ingreso'] = true;
$_SESSION['rolid'] = 1;
assertTrue(authC::isLoggedIn(), 'session marked as logged in');

exit($failures > 0 ? 1 : 0);
