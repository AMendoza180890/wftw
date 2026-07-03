<?php

declare(strict_types=1);

$scripts = [
    'stage1-password.php',
    'stage1-csrf.php',
    'stage1-auth.php',
    'stage2-atendidos.php',
    'stage2-pdf.php',
    'stage2-ui.php',
    'stage3-php.php',
    'stage4-plantilla.php',
];

$failures = 0;

foreach ($scripts as $script) {
    $path = __DIR__ . '/' . $script;
    echo "==> {$script}\n";
    passthru(PHP_BINARY . ' ' . escapeshellarg($path), $exitCode);
    echo "\n";
    if ($exitCode !== 0) {
        $failures++;
    }
}

exit($failures > 0 ? 1 : 0);
