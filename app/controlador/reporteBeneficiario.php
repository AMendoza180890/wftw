<?php
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
    use app\modelo\conexionBD;

    //require_once ('fpdf/fpdf.php');
    //DOMPDF
    // class reporteBeneficiario extends FPDF{
    //     public static function reporteBeneficiarioC(){
    if (isset($_GET["codValor"])) {
        $codigo = $_GET["codValor"];

        $pdo = conexionBD::conexion()->prepare("SELECT id, nombreApellido, fnacimiento, direccion, celular, telefono, referencia, tipoMedio, estadoMedio, apoyoMedio, diagnostico, foto, nombreTutor, cedula, parentesco, fechaCreacion, fechaBaja, fechaAtendidos FROM catbeneficiario WHERE id = :id");
        $pdo->bindParam(":id", $codigo, PDO::PARAM_INT);
        $pdo->execute();
        $infoBeneficiario = $pdo->fetch();
    }
?>

     <body>
         <h1>Titulo del documento a imprimir</h1>
         <p>parrafo del contenido</p>
         <p>id:<?php //$infoBeneficiario["id"] ?></p>
         <p>nombre:<?php //$infoBeneficiario["nombreApellido"] ?></p>
     </body>

 </html>';
 <?php
        $html = ob_get_clean();
        //DOMPDF
        // instantiate and use the dompdf class
        require_once 'dompdf/autoload.inc.php';
        use Dompdf\Dompdf;
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