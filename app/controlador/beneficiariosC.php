<?php
namespace app\controlador;
use app\modelo\beneficiariosM;
use app\controlador\tratamientoRecursos;
use DateTime;
use DateTimeZone;
use Exception;
use FPDF;
require_once ('fpdf/fpdf.php');
//require_once '../librerias/dompdf/autoload.inc.php';
//use Dompdf\Dompdf;
class beneficiariosC
{
    // mostrar en lista del beneficiario activos.
    public function mostrarListaBeneficiarioC()
    {
        try {
            $ListaBeneficiario = beneficiariosM::mostrarListaBeneficiarioM();
            if ($ListaBeneficiario != 0) {
                foreach ($ListaBeneficiario as $key => $value) {
                    echo '<tr>
                        <td>' . $value["id"] . '</td>
                        <td>' . $value["nombreApellido"] . '</td>
                        <td>' . $value["fnacimiento"] . '</td>
                        <td>' . $value["diagnostico"] . '</td>
                        <td>' . $value["celular"] . '</td>
                        <td>' . $value["telefono"] . '</td>
                        <td>' . $value["nombreTutor"] . '</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-success editarRegistroBeneficiario" codValor=' . $value["id"] . '><i data-toggle="modal" data-target="#editarbeneficiario" class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger desactivarRegistroBeneficiario" codValor=' . $value["id"] . '><i class="fa fa-times"></i></button>
                                <button class="btn btn-primary beneficiarioAtendido" CodValorAtendido=' . $value["id"] . '><i class="fa fa-print"></i></button>
                            </div>
                        </td>
                    </tr>';
                }
            }
        } catch (exception $ex) {
            echo 'error:' . $ex->getMessage();
        }
    }

    // mostrar en lista del beneficiario dado de bajas.
    public function mostrarListaBeneficiarioBajaC()
    {
        try {
            $ListaBeneficiarioBaja = beneficiariosM::mostrarListaBeneficiarioBajaM();
            if ($ListaBeneficiarioBaja != 0) {
                foreach ($ListaBeneficiarioBaja as $key => $value) {
                    echo '<tr>
                        <td>' . $value["id"] . '</td>
                        <td>' . $value["nombreApellido"] . '</td>
                        <td>' . $value["fechaBaja"] . '</td>
                        <td>' . $value["diagnostico"] . '</td>
                        <td>' . $value["celular"] . '</td>
                        <td>' . $value["telefono"] . '</td>
                        <td>' . $value["nombreTutor"] . '</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-success activarBeneficiario" codValor=' . $value["id"] . '><i class="fa fa-pencil"></i></button>
                            </div>
                        </td>
                    </tr>';
                }
            }
        } catch (exception $ex) {
            echo 'error:' . $ex->getMessage();
        }
    }

    // mostrar en lista del beneficiario atendidos.
    public function mostrarListaBeneficiarioAtendidosC()
    {
        try {
            $ListaBeneficiarioBaja = beneficiariosM::mostrarListaBeneficiarioAtendidosM();
            if ($ListaBeneficiarioBaja != 0) {
                foreach ($ListaBeneficiarioBaja as $key => $value) {
                    echo '<tr>
                        <td>' . $value["id"] . '</td>
                        <td>' . $value["nombreApellido"] . '</td>
                        <td>' . $value["fechaAtendidos"] . '</td>
                        <td>' . $value["diagnostico"] . '</td>
                        <td>' . $value["celular"] . '</td>
                        <td>' . $value["telefono"] . '</td>
                        <td>' . $value["nombreTutor"] . '</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-success editarRegistroBeneficiario" codValor=' . $value["id"] . '><i data-toggle="modal" data-target="#editarbeneficiario" class="fa fa-pencil"></i></button>
                            </div>
                        </td>
                    </tr>';
                }
            }
        } catch (exception $ex) {
            echo 'error:' . $ex->getMessage();
        }
    }

//guardar informacion del beneficiario
    public function datosGuardarBeneficiarioC()
    {
        try {
            if(isset($_POST["nombreApelido"])){
                $rutaImagenProcesada = "app/vista/img/beneficiario/defecto.png";
                if(isset($_FILES["fotoNuevo"]["tmp_name"])){
                    $rutaImagenProcesada = tratamientoRecursos::tratamientoTipoImagenBeneficiario($_FILES["fotoNuevo"]["tmp_name"], $_FILES["fotoNuevo"]);
                }
                
                //OBTENER Y DAR FORMATO LA FECHA DE MANAGUA
                $dtz = new DateTimeZone("America/Managua");
                $dt = new DateTime("now", $dtz);
                //Stores time as "2021-04-04T13:35:48":
                $currentTime = $dt->format("Y-m-d") . "T" . $dt->format("H:i:s");

                $datosBeneficiario  = array(
                    "nombreApellido" => $_POST["nombreApelido"], 
                    "fnacimiento" => $_POST["fnacimiento"],
                    "direccion" => $_POST["direccion"],
                    "celular" => $_POST["celular"],
                    "telefono" => $_POST["telefono"],
                    "referencia" => $_POST["referido"],
                    "tipoMedio" => $_POST["tMedio"],
                    "estadoMedio" => $_POST["eMedio"],
                    "apoyoMedio" => $_POST["nApoyo"],
                    "diagnostico" => $_POST["diagnostico"],
                    "foto" => $rutaImagenProcesada,
                    "nombreTutor" => $_POST["tutornombre"],
                    "cedula" => $_POST["tutorcedula"],
                    "parentesco" => $_POST["tutorparentesco"],
                    "fcreacion" => $currentTime);
                    
                $datosGuardados = beneficiariosM::datosGuardarBeneficiarioM($datosBeneficiario);
        
                if ($datosGuardados == true) {
                    echo '<script>window.location="catbeneficiario"</script>';
                } else {
                    echo 'Error - Ocurrio un error al hora de insertar';
                }
            }

        } catch (Exception $ex) {
            echo 'error:' . $ex->getMessage();
        }
    }

//recuperar informacion del beneficiario para el formulario
    public static function obtenerDatosBeneficiarioC($valor)
    {
        try {
            if (isset($valor)) {
                $consultarDatosBeneficiario = beneficiariosM::obtenerDatosBeneficiarioM($valor);
                return $consultarDatosBeneficiario;
            }
        } catch (exception $ex) {
            echo 'error:' . $ex->getMessage();
        }
    }
//actualizar al beneficiario
    public function actualizarDatosBeneficiario(){
        try {
            if(isset($_POST["nombreApelidoEdit"])){
                
                $rutaImagenProcesada = $_POST["fotoActual"];

                if(isset($_FILES["fotoNuevoEdit"]["tmp_name"])){
                    $rutaImagenProcesada = tratamientoRecursos::tratamientoTipoImagenBeneficiario($_FILES["fotoNuevoEdit"]["tmp_name"], $_FILES["fotoNuevoEdit"]);
                }

                //OBTENER Y DAR FORMATO LA FECHA DE MANAGUA
                $dtz = new DateTimeZone("America/Managua");
                $dt = new DateTime("now", $dtz);
                //Stores time as "2021-04-04T13:35:48":
                $currentTime = $dt->format("Y-m-d") . "T" . $dt->format("H:i:s");

                $datosBeneficiarioActualizar  = array(
                    "id" => $_POST["idedit"],
                    "nombreApellido" => $_POST["nombreApelidoEdit"], 
                    "fnacimiento" => $_POST["fnacimientoEdit"],
                    "direccion" => $_POST["direccionEdit"],
                    "celular" => $_POST["celularEdit"],
                    "telefono" => $_POST["telefonoEdit"],
                    "referencia" => $_POST["referidoEdit"],
                    "tipoMedio" => $_POST["tMedioEdit"],
                    "estadoMedio" => $_POST["eMedioEdit"],
                    "apoyoMedio" => $_POST["nApoyoEdit"],
                    "diagnostico" => $_POST["diagnosticoEdit"],
                    "foto" => $rutaImagenProcesada,
                    "nombreTutor" => $_POST["tutornombreEdit"],
                    "cedula" => $_POST["tutorcedulaEdit"],
                    "parentesco" => $_POST["tutorparentescoEdit"],
                    "factualizacion" => $currentTime
                );
                    
                $datosGuardados = beneficiariosM::actualizarDatosBeneficiarioM($datosBeneficiarioActualizar);
        
                if ($datosGuardados == true) {
                    echo '<script>window.location="catbeneficiario"</script>';
                } else {
                    echo 'Error - Ocurrio un error al hora de insertar';
                }
            }
        } catch (exception $ex) {
            echo 'error: '.$ex->getMessage();
        }
    }
// dar de baja al beneficiario.
    public function desactivarBeneficiarioC()
    {
        try {
            if (isset($_GET["CodValor"])) {
                //OBTENER Y DAR FORMATO LA FECHA DE MANAGUA
                $dtz = new DateTimeZone("America/Managua");
                $dt = new DateTime("now", $dtz);
                //Stores time as "2021-04-04T13:35:48":
                $currentTime = $dt->format("Y-m-d") . "T" . $dt->format("H:i:s");

                $codigo = $_GET["CodValor"];

                $datosDesactivarBeneficiario = array("id"=>$codigo, "fechaBaja" => $currentTime);

                $DesactivarBeneficiario = beneficiariosM::desactivarBeneficiarioM($datosDesactivarBeneficiario);

                if ($DesactivarBeneficiario == true) {
                    echo '<script>window.location="catbeneficiario"</script>';
                } else {
                    echo 'Error - Ocurrio un error al hora de insertar';
                }

            }
        } catch (exception $ex) {
            echo 'error ' . $ex->getMessage();
        }
    }

    //dar de alta al beneficiario
    public function activarBeneficiarioC()
    {
        try {
            if (isset($_GET["CodValor"])) {
                $codigo = $_GET["CodValor"];
                $activarBeneficiario = beneficiariosM::activarBeneficiarioM($codigo);
                if ($activarBeneficiario == true) {
                    echo '<script>window.location="catbeneficiarioBaja"</script>';
                } else {
                    echo 'Error - Ocurrio un error al hora de insertar';
                }
            }
        } catch (exception $ex) {
            echo 'error ' . $ex->getMessage();
        }
    }

    // Imprimir pagina y actualizar estado de activo a atendido al beneficiario.
    public function beneficiarioAtendidoC()
    {
        try {
            if (isset($_GET["CodValorAtendido"])) {
                //OBTENER Y DAR FORMATO LA FECHA DE MANAGUA
                $dtz = new DateTimeZone("America/Managua");
                $dt = new DateTime("now", $dtz);
                //Stores time as "2021-04-04T13:35:48":
                $currentTime = $dt->format("Y-m-d") . "T" . $dt->format("H:i:s");
                $codigo = $_GET["CodValorAtendido"];
                $beneficiarioAtendidoParametros = array('id' => $codigo , 'fechaAtendido' => $currentTime );
                $beneficiarioAtendido = beneficiariosM::beneficiarioAtendido($beneficiarioAtendidoParametros);
                if (!empty($beneficiarioAtendido)) {
                    $pdf = new FPDF();
                    $pdf->AddPage();
                    $pdf->SetFont('Arial','B',16);
                    $pdf->Cell(40,10,'Hello World!');
                    $pdf->Output('D','doc.pdf');
                   //reporteBeneficiario::reporteBeneficiarioC();
                } else {
                    echo 'Error - Ocurrio un error al hora de insertar';
                }
            }
        } catch (exception $ex) {
            echo 'error ' . $ex->getMessage();
        }
    }
}
?>