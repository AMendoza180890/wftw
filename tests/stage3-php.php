<?php

declare(strict_types=1);

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

assertTrue(version_compare(PHP_VERSION, '8.1.0', '>='), 'PHP version is 8.1+');

$composer = json_decode(file_get_contents(__DIR__ . '/../composer.json'), true);
assertTrue(($composer['require']['php'] ?? '') === '>=8.1', 'composer.json requires PHP 8.1+');

$lock = json_decode(file_get_contents(__DIR__ . '/../composer.lock'), true);
$dompdfVersion = null;

foreach ($lock['packages'] as $package) {
    if ($package['name'] === 'dompdf/dompdf') {
        $dompdfVersion = $package['version'];
        break;
    }
}

assertTrue($dompdfVersion !== null && version_compare(ltrim($dompdfVersion, 'v'), '2.0.0', '>='), 'dompdf 2.x installed (' . ($dompdfVersion ?? 'missing') . ')');

$appPhp = glob(__DIR__ . '/../app/**/*.php');
foreach ($appPhp as $file) {
    if (preg_match('/catch\s*\(\s*exception\s+\$/', file_get_contents($file))) {
        echo "FAIL: lowercase exception catch in {$file}\n";
        $failures++;
    }
}

if ($failures === 0) {
    echo "PASS: no lowercase exception catch blocks in app code\n";
}

exit($failures > 0 ? 1 : 0);
