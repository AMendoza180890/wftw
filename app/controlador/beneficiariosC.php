<?php
namespace app\controlador;
use app\modelo\beneficiariosM;
use Exception;

class beneficiariosC
{
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
                                <button style="display:none;" class="btn btn-danger DesactivarRegistroUsuario" codValor=' . $value["id"] . '><i class="fa fa-times"></i></button>
                            </div>
                        </td>
                    </tr>';
                }
            }
        } catch (exception $ex) {
            echo 'error:' . $ex->getMessage();
        }
    }

    public function datosGuardarBeneficiarioC()
    {
        try {
            if(isset($_POST["nombreApelido"])){
                $rutaImagenProcesada = "app/vista/img/beneficiario/defecto.png";
                if(isset($_FILES["fotoNuevo"]["tmp_name"])){
                    $rutaImagenProcesada = tratamientoRecursos::tratamientoTipoImagenBeneficiario($_FILES["fotoNuevo"]["tmp_name"], $_FILES["fotoNuevo"]);
                }

                $datosBeneficiario  = array(
                    "nombreApellido" => $_POST["nombreApelido"], 
                    "fnacimiento" => $_POST["fnacimiento"],
                    "direccion" => $_POST["direccion"],
                    "celular" => $_POST["celular"],
                    "telefono" => $_POST["telefono"],
                    "referencia" => $_POST["referido"],
                    "diagnostico" => $_POST["diagnostico"],
                    "foto" => $rutaImagenProcesada,
                    "nombreTutor" => $_POST["tutornombre"],
                    "cedula" => $_POST["tutorcedula"],
                    "parentesco" => $_POST["tutorparentesco"]);
                    
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

    public function actualizarDatosBeneficiario(){
        try {
            if(isset($_POST["nombreApelido"])){
                $rutaImagenProcesada = "app/vista/img/beneficiario/defecto.png";
                if(isset($_FILES["fotoNuevo"]["tmp_name"])){
                    $rutaImagenProcesada = tratamientoRecursos::tratamientoTipoImagenBeneficiario($_FILES["fotoNuevo"]["tmp_name"], $_FILES["fotoNuevo"]);
                }

                $datosBeneficiarioActualizar  = array(
                    "nombreApellido" => $_POST["nombreApelido"], 
                    "fnacimiento" => $_POST["fnacimiento"],
                    "direccion" => $_POST["direccion"],
                    "celular" => $_POST["celular"],
                    "telefono" => $_POST["telefono"],
                    "referencia" => $_POST["referido"],
                    "diagnostico" => $_POST["diagnostico"],
                    "foto" => $rutaImagenProcesada,
                    "nombreTutor" => $_POST["tutornombre"],
                    "cedula" => $_POST["tutorcedula"],
                    "parentesco" => $_POST["tutorparentesco"]);
                    
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
}