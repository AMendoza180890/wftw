<?php

declare(strict_types=1);

$source = file_get_contents(__DIR__ . '/../app/modelo/beneficiariosM.php');
$failures = 0;

if (strpos($source, 'fechaAtendidos IS NOT NULL') === false) {
    echo "FAIL: atendidos query missing fechaAtendidos IS NOT NULL\n";
    $failures++;
} else {
    echo "PASS: atendidos query filters by fechaAtendidos IS NOT NULL\n";
}

if (preg_match('/WHERE fechaBaja IS NULL ORDER BY fechaAtendidos/', $source)) {
    echo "FAIL: old atendidos query still present\n";
    $failures++;
} else {
    echo "PASS: old atendidos query removed\n";
}

exit($failures > 0 ? 1 : 0);
