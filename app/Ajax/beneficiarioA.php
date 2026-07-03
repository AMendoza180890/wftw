<?php

require __DIR__ . '/../../app/bootstrap.php';

use app\controlador\authC;
use app\controlador\beneficiariosC;

authC::requireRole([1]);

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing id']);
    exit;
}

if (!authC::validateCsrf()) {
    http_response_code(403);
    echo json_encode(['error' => 'Invalid CSRF token']);
    exit;
}

$datosObtenidosBeneficiarios = beneficiariosC::obtenerDatosBeneficiarioC((int) $_POST['id']);

if (!$datosObtenidosBeneficiarios) {
    http_response_code(404);
    echo json_encode(['error' => 'Beneficiary not found']);
    exit;
}

echo json_encode($datosObtenidosBeneficiarios);
