<?php
use app\controlador\beneficiariosC;
use FPDF;
require_once ('../fpdf/fpdf.php');
//DOMPDF
// require_once 'dompdf/autoload.inc.php';
// use Dompdf\Dompdf;
// class reporteBeneficiario extends FPDF{
//     public static function reporteBeneficiarioC(){
        if (isset($_GET["codigo"])) {
            $codigo = $_GET["codigo"];
            $datosBeneficiario = beneficiariosC::obtenerDatosBeneficiarioC($codigo);
            ob_clean();
            echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
           
            <body>
                <h1>Titulo del documento a imprimir</h1>
                <p>parrafo del contenido</p>
                <p>id:'.$datosBeneficiario["id"].'</p>
                <p>nombre:'.$datosBeneficiario["nombreApellido"].'</p>
            </body>
            </html>';
           $html = ob_get_clean();
           
           //FPDF
           $pdf = new FPDF();
           $pdf->AddPage();
           $pdf->SetFont('Arial','B',16);
           $pdf->Cell(40,10,'Hello World!');
           $pdf->Output('I');
        }

        //DOMPDF
        // instantiate and use the dompdf class
        // $dompdf = new Dompdf();
        
        // $options = $dompdf->getOptions();
        // $options -> set(array('isRemoteEnabled' => true));
        // $dompdf -> setOptions($options);
        
        // $dompdf->loadHtml($html);
        
        // // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('letter');
        
        // // Render the HTML as PDF
        // $dompdf->render();
        
        // // Output the generated PDF to Browser
        // $dompdf->stream("nombrearchivo.pdf");
//     }
// }
?>