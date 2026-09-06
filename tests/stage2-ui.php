<?php

declare(strict_types=1);

$js = file_get_contents(__DIR__ . '/../app/vista/js/beneficiario.js');
$plantilla = file_get_contents(__DIR__ . '/../app/vista/plantilla.php');
$editUsuario = file_get_contents(__DIR__ . '/../app/vista/modulos/editUsuario.php');
$crearBeneficiario = file_get_contents(__DIR__ . '/../app/vista/modulos/crearbeneficiario.php');
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

// El boton "atendido" debe abrir el reporte de entrega tras marcar la atencion.
if (strpos($js, 'reporteBeneficiario.php?codValor=') !== false) {
    echo "PASS: atendido flow opens beneficiary report\n";
} else {
    echo "FAIL: atendido flow does not open beneficiary report\n";
    $failures++;
}

// El <select> de rol en edicion de usuario debe llevar el id para que usuario.js lo pueble.
if (preg_match('/<select[^>]*name="rolEdit"[^>]*id="rolEdit"/', $editUsuario)
    || preg_match('/<select[^>]*id="rolEdit"[^>]*name="rolEdit"/', $editUsuario)) {
    echo "PASS: edit user role select carries id=rolEdit\n";
} else {
    echo "FAIL: edit user role select missing id on the <select>\n";
    $failures++;
}

// El formulario de creacion no debe contener diagnosticos de relleno.
if (strpos($crearBeneficiario, 'diagnostico3') === false
    && strpos($crearBeneficiario, 'value="TEA"') !== false) {
    echo "PASS: create form uses real diagnosis catalog\n";
} else {
    echo "FAIL: create form still has placeholder diagnoses\n";
    $failures++;
}

exit($failures > 0 ? 1 : 0);
