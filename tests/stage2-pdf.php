<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;

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

$reportSource = file_get_contents(__DIR__ . '/../app/controlador/reporteBeneficiario.php');
assertTrue(strpos($reportSource, 'ob_start()') !== false, 'report uses ob_start');
assertTrue(strpos($reportSource, 'Dompdf\\Dompdf') !== false, 'report uses Composer Dompdf');
assertTrue(strpos($reportSource, 'dompdf/autoload.inc.php') === false, 'report does not use vendored autoload');
assertTrue(!is_dir(__DIR__ . '/../app/controlador/dompdf'), 'vendored dompdf folder removed');

$dompdf = new Dompdf();
$dompdf->loadHtml('<html><body><p>Stage 2 PDF smoke test</p></body></html>');
$dompdf->render();
$output = $dompdf->output();
assertTrue(is_string($output) && strlen($output) > 100, 'dompdf renders PDF bytes');

exit($failures > 0 ? 1 : 0);
