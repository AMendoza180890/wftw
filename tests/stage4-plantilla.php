<?php

declare(strict_types=1);

$source = file_get_contents(__DIR__ . '/../app/vista/plantilla.php');
$failures = 0;

function assertContains(string $needle, string $haystack, string $label): void
{
    global $failures;

    if (strpos($haystack, $needle) === false) {
        echo "FAIL: {$label}\n";
        $failures++;
    } else {
        echo "PASS: {$label}\n";
    }
}

function assertNotContains(string $needle, string $haystack, string $label): void
{
    global $failures;

    if (strpos($haystack, $needle) !== false) {
        echo "FAIL: {$label}\n";
        $failures++;
    } else {
        echo "PASS: {$label}\n";
    }
}

assertContains('cdn.datatables.net/v/dt/dt-2.2.2/datatables.min.js', $source, 'DataTables 2.2.2 bundle loaded');
assertContains('integrity="sha384-', $source, 'SRI attributes present');
assertContains('jquery-3.7.1.min.js', $source, 'jQuery 3.7.1 pinned via CDN');
assertNotContains('demo.js', $source, 'demo.js removed from production');
assertNotContains('dashboard.js', $source, 'dashboard.js removed from production');
assertNotContains('morris.min.js', $source, 'unused morris.js removed');
assertNotContains('1.10.24', $source, 'DataTables 1.10.24 removed');

exit($failures > 0 ? 1 : 0);
