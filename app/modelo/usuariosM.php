<?php

namespace app\modelo;

use app\modelo\conexionBD;
use Exception;
use PDO;

class usuariosM extends conexionBD
{
    public static function ingresoSesionUsuario(array $datosC)
    {
        try {
            $pdo = conexionBD::conexion()->prepare(
                'SELECT usuarios.id, usuarios.usuario, usuarios.clave, usuarios.foto, usuarios.rolid, catroles.catRolesDescripcion
                 FROM usuarios
                 INNER JOIN catroles ON usuarios.rolid = catroles.rolid
                 WHERE usuarios.usuario = :usuario'
            );

            $pdo->bindParam(':usuario', $datosC['user'], PDO::PARAM_STR);
            $pdo->execute();

            return $pdo->fetch();
        } catch (Exception $ex) {
            echo 'Error - ' . $ex;

            return false;
        }
    }

    public static function actualizarClaveM(int $id, string $hash): bool
    {
        try {
            $pdo = conexionBD::conexion()->prepare('UPDATE usuarios SET clave = :clave WHERE id = :id');
            $pdo->bindParam(':id', $id, PDO::PARAM_INT);
            $pdo->bindParam(':clave', $hash, PDO::PARAM_STR);

            return $pdo->execute();
        } catch (Exception $ex) {
            echo 'Error - ' . $ex;

            return false;
        }
    }

    public static function listadeUsuariosM()
    {
        try {
            $pdo = conexionBD::conexion()->prepare(
                'SELECT usuarios.id, usuarios.usuario, usuarios.foto, usuarios.rolid, catroles.catRolesDescripcion
                 FROM usuarios
                 INNER JOIN catroles ON usuarios.rolid = catroles.rolid'
            );
            $pdo->execute();

            return $pdo->fetchAll();
        } catch (Exception $ex) {
            echo 'error - ' . $ex;

            return false;
        }
    }

    public static function registrarUsuariosM(array $datosNuevoUsuario)
    {
        try {
            $pdo = conexionBD::conexion()->prepare(
                'INSERT INTO usuarios (usuario, clave, foto, rolid) VALUES (:usuario, :clave, :foto, :rolid)'
            );

            $pdo->bindParam('usuario', $datosNuevoUsuario['usuario'], PDO::PARAM_STR);
            $pdo->bindParam('clave', $datosNuevoUsuario['clave'], PDO::PARAM_STR);
            $pdo->bindParam('foto', $datosNuevoUsuario['foto'], PDO::PARAM_STR);
            $pdo->bindParam('rolid', $datosNuevoUsuario['rol'], PDO::PARAM_INT);

            return $pdo->execute();
        } catch (Exception $ex) {
            echo 'Error - ' . $ex;

            return false;
        }
    }

    public static function editarRegistroUsuarioM($datosEditarUsuario)
    {
        try {
            if ($datosEditarUsuario === null) {
                return false;
            }

            $pdo = conexionBD::conexion()->prepare(
                'SELECT usuarios.id, usuarios.usuario, usuarios.foto, usuarios.rolid, catroles.catRolesDescripcion
                 FROM usuarios
                 INNER JOIN catroles ON usuarios.rolid = catroles.rolid
                 WHERE usuarios.id = :id'
            );

            $pdo->bindParam('id', $datosEditarUsuario, PDO::PARAM_INT);
            $pdo->execute();

            return $pdo->fetch();
        } catch (Exception $ex) {
            echo 'Error - ' . $ex;

            return false;
        }
    }

    public static function DesactivarRegistroUsuarioM($codigoUsuario)
    {
        try {
            $pdo = conexionBD::conexion()->prepare('UPDATE usuarios SET rolid = 3 WHERE id = :id');
            $pdo->bindParam('id', $codigoUsuario, PDO::PARAM_INT);

            return $pdo->execute();
        } catch (Exception $ex) {
            echo 'Error - ' . $ex;

            return false;
        }
    }

    public static function actualizarRegistroUsuarioM(array $datosActualizarUsuario)
    {
        try {
            if (!empty($datosActualizarUsuario['clave'])) {
                $sql = 'UPDATE usuarios SET usuario = :usuario, clave = :clave, foto = :foto, rolid = :rolid WHERE id = :id';
            } else {
                $sql = 'UPDATE usuarios SET usuario = :usuario, foto = :foto, rolid = :rolid WHERE id = :id';
            }

            $pdo = conexionBD::conexion()->prepare($sql);

            $pdo->bindParam('id', $datosActualizarUsuario['id'], PDO::PARAM_INT);
            $pdo->bindParam('usuario', $datosActualizarUsuario['usuario'], PDO::PARAM_STR);
            $pdo->bindParam('foto', $datosActualizarUsuario['foto'], PDO::PARAM_STR);
            $pdo->bindParam('rolid', $datosActualizarUsuario['rol'], PDO::PARAM_INT);

            if (!empty($datosActualizarUsuario['clave'])) {
                $pdo->bindParam('clave', $datosActualizarUsuario['clave'], PDO::PARAM_STR);
            }

            return $pdo->execute();
        } catch (Exception $ex) {
            echo 'Error - ' . $ex;

            return false;
        }
    }
}
