<?php

declare(strict_types=1);

$js = file_get_contents(__DIR__ . '/../app/vista/js/beneficiario.js');
$plantilla = file_get_contents(__DIR__ . '/../app/vista/plantilla.php');
$failures = 0;

$checks = [
    ['#diagnosticoEdit").val(', 'diagnostico select uses parent id'],
    ['#tMedioEdit").val(', 'tipo medio select uses parent id'],
    ['#eMedioEdit").val(', 'estado medio select uses parent id'],
    ['#nApoyoEdit").val(', 'apoyo select uses parent id'],
    ['#tutorparentescoEdit").val(', 'parentesco select uses parent id'],
    ['#institucionEdit").val(', 'institucion select uses parent id'],
];

foreach ($checks as [$needle, $label]) {
    if (strpos($js, $needle) === false) {
        echo "FAIL: {$label}\n";
        $failures++;
    } else {
        echo "PASS: {$label}\n";
    }
}

if (strpos($plantilla, "include 'modulos/inicio.php'") !== false
    && strpos($plantilla, "include 'modulos/login.php'") !== false) {
    echo "PASS: authenticated default route loads inicio\n";
} else {
    echo "FAIL: plantilla routing not fixed\n";
    $failures++;
}

exit($failures > 0 ? 1 : 0);
