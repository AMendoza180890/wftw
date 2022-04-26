<?php
if (!headers_sent()) {
session_start();
}
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
 </head>
 <?php
    include '../modelo/envConexion.php';
    include '../modelo/conexionBD.php';
    include '../modelo/beneficiariosM.php';
    include 'beneficiariosC.php';
    use app\controlador\beneficiariosC;
    //require_once ('fpdf/fpdf.php');
    //DOMPDF
    // class reporteBeneficiario extends FPDF{
    //     public static function reporteBeneficiarioC(){
    $beneficiario = new beneficiariosC();
    $codValor = 1;
    if (!empty($codValor)) {
        $codigo = $codValor;
        $datosBeneficiario = $beneficiario::obtenerDatosBeneficiarioC($codigo);
    }
?>

     <body>
         <h1>Titulo del documento a imprimir</h1>
         <p>parrafo del contenido</p>
         <p>id:<?php $datosBeneficiario["id"] ?></p>
         <p>nombre:<?php $datosBeneficiario["nombreApellido"] ?></p>
     </body>

 </html>';
 <?php
        $html = ob_get_clean();
        //DOMPDF
        // instantiate and use the dompdf class
        use Dompdf\Dompdf;
        require_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf();

        $options = $dompdf->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);
        // // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('letter');
        // // Render the HTML as PDF
        $dompdf->render();
        // // Output the generated PDF to Browser
        $dompdf->stream($datosBeneficiario["nombreApellido"] . ".pdf", array("Attachment"=>false));
        //FPDF
        //    $pdf = new FPDF();
        //    $pdf->AddPage();
        //    $pdf->SetFont('Arial','B',16);
        //    $pdf->Write($html);
        //    $pdf->Output('D',$datosBeneficiario["nombreApellido"].".pdf");

    //     }
    // }
?>