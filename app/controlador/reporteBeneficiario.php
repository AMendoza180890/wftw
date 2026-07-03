<?php

require __DIR__ . '/../../app/bootstrap.php';

use app\controlador\authC;
use app\modelo\conexionBD;
use Dompdf\Dompdf;
use Dompdf\Options;

authC::requireLogin();

if (!isset($_GET['codValor'])) {
    http_response_code(400);
    exit('Bad request');
}

$codigo = (int) $_GET['codValor'];

$pdo = conexionBD::conexion()->prepare(
    'SELECT id, nombreApellido, fnacimiento, direccion, celular, telefono, referencia,
            tipoMedio, estadoMedio, apoyoMedio, diagnostico, foto, nombreTutor, cedula,
            parentesco, institucion, fechaCreacion, fechaBaja, fechaAtendidos
     FROM catbeneficiario WHERE id = :id'
);
$pdo->bindParam(':id', $codigo, PDO::PARAM_INT);
$pdo->execute();
$infoBeneficiario = $pdo->fetch();

if (!$infoBeneficiario) {
    http_response_code(404);
    exit('Not found');
}

ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Beneficiario</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        h1 { text-align: center; color: #1a5276; font-size: 20px; }
        .section { margin-bottom: 16px; }
        .label { font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        td { padding: 6px 8px; vertical-align: top; border-bottom: 1px solid #ddd; }
        td.label { width: 35%; }
    </style>
</head>
<body>
    <h1>Wheels for the World — Reporte de Beneficiario</h1>

    <div class="section">
        <table>
            <tr><td class="label">ID</td><td><?php echo e((string) $infoBeneficiario['id']); ?></td></tr>
            <tr><td class="label">Nombre completo</td><td><?php echo e($infoBeneficiario['nombreApellido']); ?></td></tr>
            <tr><td class="label">Fecha de nacimiento</td><td><?php echo e($infoBeneficiario['fnacimiento']); ?></td></tr>
            <tr><td class="label">Direccion</td><td><?php echo e($infoBeneficiario['direccion']); ?></td></tr>
            <tr><td class="label">Diagnostico</td><td><?php echo e($infoBeneficiario['diagnostico']); ?></td></tr>
            <tr><td class="label">Institucion</td><td><?php echo e($infoBeneficiario['institucion']); ?></td></tr>
        </table>
    </div>

    <div class="section">
        <h2>Medio auxiliar</h2>
        <table>
            <tr><td class="label">Tipo de medio</td><td><?php echo e($infoBeneficiario['tipoMedio']); ?></td></tr>
            <tr><td class="label">Estado del medio</td><td><?php echo e($infoBeneficiario['estadoMedio']); ?></td></tr>
            <tr><td class="label">Nivel de apoyo</td><td><?php echo e($infoBeneficiario['apoyoMedio']); ?></td></tr>
        </table>
    </div>

    <div class="section">
        <h2>Contacto y tutor</h2>
        <table>
            <tr><td class="label">Celular</td><td><?php echo e($infoBeneficiario['celular']); ?></td></tr>
            <tr><td class="label">Telefono</td><td><?php echo e($infoBeneficiario['telefono']); ?></td></tr>
            <tr><td class="label">Referido por</td><td><?php echo e($infoBeneficiario['referencia']); ?></td></tr>
            <tr><td class="label">Nombre del tutor</td><td><?php echo e($infoBeneficiario['nombreTutor']); ?></td></tr>
            <tr><td class="label">Cedula del tutor</td><td><?php echo e($infoBeneficiario['cedula']); ?></td></tr>
            <tr><td class="label">Parentesco</td><td><?php echo e($infoBeneficiario['parentesco']); ?></td></tr>
        </table>
    </div>

    <div class="section">
        <table>
            <tr><td class="label">Fecha de registro</td><td><?php echo e($infoBeneficiario['fechaCreacion']); ?></td></tr>
            <tr><td class="label">Fecha atendido</td><td><?php echo e($infoBeneficiario['fechaAtendidos']); ?></td></tr>
        </table>
    </div>
</body>
</html>
<?php
$html = ob_get_clean();

$options = new Options();
$options->set('isRemoteEnabled', false);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();

$filename = preg_replace('/[^a-zA-Z0-9_-]+/', '_', $infoBeneficiario['nombreApellido']) . '.pdf';
$dompdf->stream($filename, ['Attachment' => true]);
