<?php

namespace app\controlador;

use app\modelo\beneficiariosM;
use DateTime;
use DateTimeZone;
use Exception;

class beneficiariosC
{
    public function mostrarListaBeneficiarioC()
    {
        try {
            $ListaBeneficiario = beneficiariosM::mostrarListaBeneficiarioM();

            if ($ListaBeneficiario) {
                foreach ($ListaBeneficiario as $value) {
                    echo '<tr>
                        <td>' . e((string) $value['id']) . '</td>
                        <td>' . e($value['nombreApellido']) . '</td>
                        <td>' . e($value['fnacimiento']) . '</td>
                        <td>' . e($value['diagnostico']) . '</td>
                        <td>' . e($value['cedula']) . '</td>
                        <td>' . e($value['telefono']) . '</td>
                        <td>' . e($value['nombreTutor']) . '</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success editarRegistroBeneficiario" codValor="' . e((string) $value['id']) . '"><i data-toggle="modal" data-target="#editarbeneficiario" class="fa fa-pencil"></i></button>
                                <button type="button" class="btn btn-danger desactivarRegistroBeneficiario" codValor="' . e((string) $value['id']) . '"><i class="fa fa-times"></i></button>
                                <button type="button" class="btn btn-primary beneficiarioAtendido" CodValorAtendido="' . e((string) $value['id']) . '"><i class="fa fa-print"></i></button>
                            </div>
                        </td>
                    </tr>';
                }
            }
        } catch (Exception $ex) {
            echo 'error:' . $ex->getMessage();
        }
    }

    public function mostrarListaBeneficiarioBajaC()
    {
        try {
            $ListaBeneficiarioBaja = beneficiariosM::mostrarListaBeneficiarioBajaM();

            if ($ListaBeneficiarioBaja) {
                foreach ($ListaBeneficiarioBaja as $value) {
                    echo '<tr>
                        <td>' . e((string) $value['id']) . '</td>
                        <td>' . e($value['nombreApellido']) . '</td>
                        <td>' . e($value['fechaBaja']) . '</td>
                        <td>' . e($value['diagnostico']) . '</td>
                        <td>' . e($value['cedula']) . '</td>
                        <td>' . e($value['telefono']) . '</td>
                        <td>' . e($value['nombreTutor']) . '</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success activarBeneficiario" codValor="' . e((string) $value['id']) . '"><i class="fa fa-pencil"></i></button>
                            </div>
                        </td>
                    </tr>';
                }
            }
        } catch (Exception $ex) {
            echo 'error:' . $ex->getMessage();
        }
    }

    public function mostrarListaBeneficiarioAtendidosC()
    {
        try {
            $ListaBeneficiarioBaja = beneficiariosM::mostrarListaBeneficiarioAtendidosM();

            if ($ListaBeneficiarioBaja) {
                foreach ($ListaBeneficiarioBaja as $value) {
                    echo '<tr>
                        <td>' . e((string) $value['id']) . '</td>
                        <td>' . e($value['nombreApellido']) . '</td>
                        <td>' . e($value['fechaAtendidos']) . '</td>
                        <td>' . e($value['diagnostico']) . '</td>
                        <td>' . e($value['cedula']) . '</td>
                        <td>' . e($value['telefono']) . '</td>
                        <td>' . e($value['nombreTutor']) . '</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success editarRegistroBeneficiario" codValor="' . e((string) $value['id']) . '"><i data-toggle="modal" data-target="#editarbeneficiario" class="fa fa-pencil"></i></button>
                            </div>
                        </td>
                    </tr>';
                }
            }
        } catch (Exception $ex) {
            echo 'error:' . $ex->getMessage();
        }
    }

    public function datosGuardarBeneficiarioC()
    {
        try {
            if (!isset($_POST['nombreApelido'])) {
                return;
            }

            authC::requireCsrf();

            $rutaImagenProcesada = 'app/vista/img/beneficiario/defecto.png';

            if (!empty($_FILES['fotoNuevo']['tmp_name'])) {
                $uploaded = tratamientoRecursos::tratamientoTipoImagenBeneficiario(
                    $_FILES['fotoNuevo']['tmp_name'],
                    $_FILES['fotoNuevo']
                );

                if ($uploaded !== '') {
                    $rutaImagenProcesada = $uploaded;
                }
            }

            $dtz = new DateTimeZone('America/Managua');
            $dt = new DateTime('now', $dtz);
            $currentTime = $dt->format('Y-m-d') . 'T' . $dt->format('H:i:s');

            $datosBeneficiario = [
                'nombreApellido' => $_POST['nombreApelido'],
                'fnacimiento' => $_POST['fnacimiento'],
                'direccion' => $_POST['direccion'],
                'celular' => $_POST['celular'],
                'telefono' => $_POST['telefono'],
                'referencia' => $_POST['referido'],
                'tipoMedio' => $_POST['tMedio'],
                'estadoMedio' => $_POST['eMedio'],
                'apoyoMedio' => $_POST['nApoyo'],
                'diagnostico' => $_POST['diagnostico'],
                'foto' => $rutaImagenProcesada,
                'nombreTutor' => $_POST['tutornombre'],
                'cedula' => $_POST['tutorcedula'],
                'parentesco' => $_POST['tutorparentesco'],
                'fcreacion' => $currentTime,
                'institucion' => $_POST['institucion'],
            ];

            if (beneficiariosM::datosGuardarBeneficiarioM($datosBeneficiario)) {
                echo '<script>window.location="catbeneficiario"</script>';
            } else {
                echo 'Error - Ocurrio un error al hora de insertar';
            }
        } catch (Exception $ex) {
            echo 'error:' . $ex->getMessage();
        }
    }

    public static function obtenerDatosBeneficiarioC($valor)
    {
        try {
            if (isset($valor)) {
                return beneficiariosM::obtenerDatosBeneficiarioM($valor);
            }
        } catch (Exception $ex) {
            echo 'error:' . $ex->getMessage();
        }

        return false;
    }

    public function actualizarDatosBeneficiario()
    {
        try {
            if (!isset($_POST['nombreApelidoEdit'])) {
                return;
            }

            authC::requireCsrf();

            $rutaImagenProcesada = $_POST['fotoActual'];

            if (!empty($_FILES['fotoNuevoEdit']['tmp_name'])) {
                $uploaded = tratamientoRecursos::tratamientoTipoImagenBeneficiario(
                    $_FILES['fotoNuevoEdit']['tmp_name'],
                    $_FILES['fotoNuevoEdit']
                );

                if ($uploaded !== '') {
                    $rutaImagenProcesada = $uploaded;
                }
            }

            $dtz = new DateTimeZone('America/Managua');
            $dt = new DateTime('now', $dtz);
            $currentTime = $dt->format('Y-m-d') . 'T' . $dt->format('H:i:s');

            $datosBeneficiarioActualizar = [
                'id' => $_POST['idedit'],
                'nombreApellido' => $_POST['nombreApelidoEdit'],
                'fnacimiento' => $_POST['fnacimientoEdit'],
                'direccion' => $_POST['direccionEdit'],
                'celular' => $_POST['celularEdit'],
                'telefono' => $_POST['telefonoEdit'],
                'referencia' => $_POST['referidoEdit'],
                'tipoMedio' => $_POST['tMedioEdit'],
                'estadoMedio' => $_POST['eMedioEdit'],
                'apoyoMedio' => $_POST['nApoyoEdit'],
                'diagnostico' => $_POST['diagnosticoEdit'],
                'foto' => $rutaImagenProcesada,
                'nombreTutor' => $_POST['tutornombreEdit'],
                'cedula' => $_POST['tutorcedulaEdit'],
                'parentesco' => $_POST['tutorparentescoEdit'],
                'factualizacion' => $currentTime,
                'institucion' => $_POST['institucionEdit'],
            ];

            if (beneficiariosM::actualizarDatosBeneficiarioM($datosBeneficiarioActualizar)) {
                echo '<script>window.location="catbeneficiario"</script>';
            } else {
                echo 'Error - Ocurrio un error al hora de insertar';
            }
        } catch (Exception $ex) {
            echo 'error: ' . $ex->getMessage();
        }
    }

    public function desactivarBeneficiarioC()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['CodValor'])) {
                return;
            }

            authC::requireCsrf();

            $dtz = new DateTimeZone('America/Managua');
            $dt = new DateTime('now', $dtz);
            $currentTime = $dt->format('Y-m-d') . 'T' . $dt->format('H:i:s');
            $codigo = (int) $_POST['CodValor'];

            $datosDesactivarBeneficiario = ['id' => $codigo, 'fechaBaja' => $currentTime];

            if (beneficiariosM::desactivarBeneficiarioM($datosDesactivarBeneficiario)) {
                echo '<script>window.location="catbeneficiario"</script>';
            } else {
                echo 'Error - Ocurrio un error al hora de insertar';
            }
        } catch (Exception $ex) {
            echo 'error ' . $ex->getMessage();
        }
    }

    public function activarBeneficiarioC()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['CodValor'])) {
                return;
            }

            authC::requireCsrf();

            $codigo = (int) $_POST['CodValor'];

            if (beneficiariosM::activarBeneficiarioM($codigo)) {
                echo '<script>window.location="catbeneficiarioBaja"</script>';
            } else {
                echo 'Error - Ocurrio un error al hora de insertar';
            }
        } catch (Exception $ex) {
            echo 'error ' . $ex->getMessage();
        }
    }

    public function beneficiarioAtendidoC()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['CodValorAtendido'])) {
                return;
            }

            authC::requireCsrf();

            $dtz = new DateTimeZone('America/Managua');
            $dt = new DateTime('now', $dtz);
            $currentTime = $dt->format('Y-m-d') . 'T' . $dt->format('H:i:s');
            $codigo = (int) $_POST['CodValorAtendido'];

            $beneficiarioAtendidoParametros = ['id' => $codigo, 'fechaAtendido' => $currentTime];

            if (beneficiariosM::beneficiarioAtendido($beneficiarioAtendidoParametros)) {
                echo '<script>window.open("app/controlador/reporteBeneficiario.php?codValor=' . e((string) $codigo) . '");</script>';
                echo '<script>window.location="catbeneficiario"</script>';
            } else {
                echo 'Error - Ocurrio un error al hora de insertar';
            }
        } catch (Exception $ex) {
            echo 'error ' . $ex->getMessage();
        }
    }
}
