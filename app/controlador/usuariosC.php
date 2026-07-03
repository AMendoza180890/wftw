<?php

namespace app\controlador;

use app\modelo\passwordM;
use app\modelo\usuariosM;
use Exception;

class usuariosC
{
    public function ingresoUsuariosC()
    {
        try {
            if (!isset($_POST['usuarioIngreso'])) {
                return;
            }

            authC::requireCsrf();

            if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['usuarioIngreso'])
                || !preg_match('/^[a-zA-Z0-9!@#$%^&*._+-]+$/', $_POST['passWord'])) {
                echo 'Error con el usuario o clave';

                return;
            }

            $datosC = [
                'user' => $_POST['usuarioIngreso'],
                'pass' => $_POST['passWord'],
            ];

            $inicioSesion = usuariosM::ingresoSesionUsuario($datosC);

            if (!$inicioSesion || (int) $inicioSesion['rolid'] !== 1) {
                echo 'Error con el usuario o clave';

                return;
            }

            if (!passwordM::verify($datosC['pass'], $inicioSesion['clave'])) {
                echo 'Error con el usuario o clave';

                return;
            }

            if (passwordM::needsRehash($inicioSesion['clave'])) {
                usuariosM::actualizarClaveM((int) $inicioSesion['id'], passwordM::hash($datosC['pass']));
            }

            session_regenerate_id(true);

            $_SESSION['ingreso'] = true;
            $_SESSION['id'] = $inicioSesion['id'];
            $_SESSION['usuario'] = $inicioSesion['usuario'];
            $_SESSION['foto'] = $inicioSesion['foto'];
            $_SESSION['rolid'] = (int) $inicioSesion['rolid'];
            $_SESSION['rol'] = $inicioSesion['catRolesDescripcion'];

            echo '<script>window.location = "inicio";</script>';
        } catch (Exception $ex) {
            echo 'Error - ' . $ex;
        }
    }

    public function listadeUsuarios()
    {
        try {
            $listaUsuario = usuariosM::listadeUsuariosM();

            if ($listaUsuario) {
                foreach ($listaUsuario as $key => $value) {
                    $foto = (is_null($value['foto']) || $value['foto'] === '')
                        ? 'app/vista/img/usuario/defecto.png'
                        : $value['foto'];

                    echo '<tr>
                    <td>' . e((string) ($key + 1)) . '</td>
                    <td>' . e($value['usuario']) . '</td>
                    <td><img src="' . e($foto) . '" class="user-image" width="40px" alt="User Image"></td>
                    <td>' . e($value['catRolesDescripcion']) . '</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success EditRegistroUsuario" codValor="' . e((string) $value['id']) . '"><i data-toggle="modal" data-target="#editarUsuario" class="fa fa-pencil"></i></button>
                            <button type="button" class="btn btn-danger DesactivarRegistroUsuario" codValor="' . e((string) $value['id']) . '"><i class="fa fa-times"></i></button>
                        </div>
                    </td>
                </tr>';
                }
            }
        } catch (Exception $ex) {
            echo 'Error - ' . $ex;
        }
    }

    public function registrarUsuariosC()
    {
        try {
            if (!isset($_POST['usuarioNuevo'])) {
                return;
            }

            authC::requireCsrf();

            $rutaImagenProcesada = imagenUpload::guardar(
                $_FILES['fotoNuevo']['tmp_name'] ?? '',
                $_FILES['fotoNuevo'] ?? [],
                'app/vista/img/usuario',
                'U'
            );

            $datosNuevoUsuario = [
                'usuario' => $_POST['usuarioNuevo'],
                'clave' => passwordM::hash($_POST['claveNuevo']),
                'rol' => $_POST['rolNuevo'],
                'foto' => $rutaImagenProcesada,
            ];

            if (usuariosM::registrarUsuariosM($datosNuevoUsuario)) {
                echo '<script>window.location="catusuarios"</script>';
            } else {
                echo 'Error - Ocurrio un error al hora de insertar';
            }
        } catch (Exception $ex) {
            echo 'Error - ' . $ex;
        }
    }

    public static function editarRegistroUsuarioC($valor)
    {
        try {
            return usuariosM::editarRegistroUsuarioM($valor);
        } catch (Exception $ex) {
            echo 'Error -' . $ex;

            return false;
        }
    }

    public function actualizarRegistroUsuarioC()
    {
        try {
            if (!isset($_POST['idEdit'])) {
                return;
            }

            authC::requireCsrf();

            $rutaImagen = $_POST['fotoActual'];

            if (!empty($_FILES['fotoEdit']['tmp_name'])) {
                $nuevaImagen = imagenUpload::guardar(
                    $_FILES['fotoEdit']['tmp_name'],
                    $_FILES['fotoEdit'],
                    'app/vista/img/usuario',
                    'U'
                );

                if ($nuevaImagen !== '') {
                    $rutaImagen = $nuevaImagen;
                }
            }

            $datosActualizarUsuario = [
                'id' => $_POST['idEdit'],
                'usuario' => $_POST['usuarioEdit'],
                'clave' => '',
                'rol' => $_POST['rolEdit'],
                'foto' => $rutaImagen,
            ];

            if (!empty($_POST['claveEdit'])) {
                $datosActualizarUsuario['clave'] = passwordM::hash($_POST['claveEdit']);
            }

            if (usuariosM::actualizarRegistroUsuarioM($datosActualizarUsuario)) {
                echo '<script>window.location = "catusuarios"</script>';
            } else {
                echo 'Hay un error no se pudo realizar actualizacion';
            }
        } catch (Exception $ex) {
            echo 'Error - ' . $ex;
        }
    }

    public function DesactivarUsuarioC()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['CodValor'])) {
                return;
            }

            authC::requireCsrf();

            $codigoUsuario = (int) $_POST['CodValor'];

            if (usuariosM::DesactivarRegistroUsuarioM($codigoUsuario)) {
                echo '<script>window.location="catusuarios"</script>';
            } else {
                echo 'Hubo un error, favor reportarlo al administrador del sistema';
            }
        } catch (Exception $ex) {
            echo 'Error - ' . $ex;
        }
    }
}
