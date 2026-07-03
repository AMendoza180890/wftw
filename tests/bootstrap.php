<?php

declare(strict_types=1);

ob_start();

require __DIR__ . '/../vendor/autoload.php';

if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}
