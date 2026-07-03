<?php

require __DIR__ . '/../../app/bootstrap.php';

use app\controlador\authC;
use app\controlador\usuariosC;

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

$editarUsuario = usuariosC::editarRegistroUsuarioC((int) $_POST['id']);

if (!$editarUsuario) {
    http_response_code(404);
    echo json_encode(['error' => 'User not found']);
    exit;
}

echo json_encode($editarUsuario);
