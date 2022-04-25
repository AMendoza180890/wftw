<?php

namespace app\modelo;
use app\modelo\conexionBD;
use Exception;
use PDO;

//require_once 'conexionBD.php';
class beneficiariosM extends conexionBD
{
// lista de beneficiarios activos
    public static function mostrarListaBeneficiarioM()
    {
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT id, nombreApellido, fnacimiento, direccion, celular, telefono, referencia, diagnostico, foto, nombreTutor, cedula, parentesco FROM catbeneficiario WHERE fechaBaja IS NULL ORDER BY fechaCreacion ASC");
            $pdo->execute();
            return $pdo->fetchAll();
        } catch (Exception $ex) {
            echo 'error: ' . $ex->getMessage();
        }
    }

    // lista de beneficiarios dados de baja
    public static function mostrarListaBeneficiarioBajaM()
    {
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT id, nombreApellido, fnacimiento, direccion, celular, telefono, referencia, diagnostico, foto, nombreTutor, cedula, parentesco, fechaBaja FROM catbeneficiario WHERE fechaBaja IS NOT NULL ORDER BY fechaBaja ASC");
            $pdo->execute();
            return $pdo->fetchAll();
        } catch (Exception $ex) {
            echo 'error: ' . $ex->getMessage();
        }
    }

    // lista de beneficiarios Atendidos
    public static function mostrarListaBeneficiarioAtendidosM()
    {
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT id, nombreApellido, fnacimiento, direccion, celular, telefono, referencia, diagnostico, foto, nombreTutor, cedula, parentesco, fechaBaja,fechaAtendidos FROM catbeneficiario WHERE fechaAtendidos IS NOT NULL  ORDER BY fechaAtendidos ASC");
            $pdo->execute();
            return $pdo->fetchAll();
        } catch (Exception $ex) {
            echo 'error: ' . $ex->getMessage();
        }
    }

    // Funcion para guardar datos
    public static function datosGuardarBeneficiarioM($datoBeneficiario)
    {
        try {
            $pdo = conexionBD::conexion()->prepare("INSERT INTO catbeneficiario(nombreApellido, fnacimiento, direccion, celular, telefono, referencia,tipoMedio, estadoMedio, apoyoMedio, diagnostico, foto, nombreTutor, cedula, parentesco, fechaCreacion) VALUES (:nombreApellido, :fnacimiento, :direccion, :celular, :telefono, :referencia, :tipoMedio,:estadoMedio,:apoyoMedio,:diagnostico, :foto, :nombreTutor, :cedula, :parentesco, :fcreacion)");

            $pdo->bindParam(":nombreApellido", $datoBeneficiario["nombreApellido"], PDO::PARAM_STR);
            $pdo->bindParam(":fnacimiento", $datoBeneficiario["fnacimiento"], PDO::PARAM_STR);
            $pdo->bindParam(":direccion", $datoBeneficiario["direccion"], PDO::PARAM_STR);
            $pdo->bindParam(":celular", $datoBeneficiario["celular"], PDO::PARAM_STR);
            $pdo->bindParam(":telefono", $datoBeneficiario["telefono"], PDO::PARAM_STR);
            $pdo->bindParam(":referencia", $datoBeneficiario["referencia"], PDO::PARAM_STR);

            $pdo->bindParam(":", $datoBeneficiario["tipoMedio"], PDO::PARAM_STR);
            $pdo->bindParam(":", $datoBeneficiario["estadoMedio"], PDO::PARAM_STR);
            $pdo->bindParam(":", $datoBeneficiario["apoyoMedio"], PDO::PARAM_STR);

            $pdo->bindParam(":diagnostico", $datoBeneficiario["diagnostico"], PDO::PARAM_STR);
            $pdo->bindParam(":foto", $datoBeneficiario["foto"], PDO::PARAM_STR);
            $pdo->bindParam(":nombreTutor", $datoBeneficiario["nombreTutor"], PDO::PARAM_STR);
            $pdo->bindParam(":cedula", $datoBeneficiario["cedula"], PDO::PARAM_STR);
            $pdo->bindParam(":parentesco", $datoBeneficiario["parentesco"], PDO::PARAM_STR);
            $pdo->bindParam(":fcreacion", $datoBeneficiario["fcreacion"],PDO::PARAM_STR);

            return ($pdo->execute()?true:false);

        } catch (exception $ex) {
            echo 'error: ' . $ex->getMessage();
        }
    }

    // funcion para obtener datos
    public static function obtenerDatosBeneficiarioM($valor){
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT id, nombreApellido, fnacimiento, direccion, celular, telefono, referencia, tipoMedio, estadoMedio, apoyoMedio, diagnostico, foto, nombreTutor, cedula, parentesco, fechaCreacion, fechaBaja, fechaAtendidos FROM catbeneficiario WHERE id = :id");

            $pdo -> bindParam(":id",$valor,PDO::PARAM_INT);
            $pdo->execute();
            return $pdo->fetch();
        } catch (exception $ex) {
            echo 'error: '.$ex->getMessage();
        }
    }

    // funcion para actualizar los datos del beneficiario.
    public static function actualizarDatosBeneficiarioM($datosBeneficiarioActualizar){
        try {
            
            $pdo = conexionBD::conexion()->prepare("UPDATE catbeneficiario SET 
            nombreApellido=:nombreApellido,
            fnacimiento=:fnacimiento,
            direccion=:direccion,
            celular=:celular,
            telefono=:telefono,
            referencia=:referencia,
            tipoMedio = :tipoMedio,
            estadoMedio = :estadoMedio,
            apoyoMedio = :apoyoMedio,
            diagnostico=:diagnostico,
            foto=:foto,
            nombreTutor=:nombreTutor,
            cedula=:cedula,
            parentesco=:parentesco,
            fechaCreacion=:factualizacion
            WHERE id=:id");

            $pdo->bindParam(":id", $datosBeneficiarioActualizar["id"], PDO::PARAM_STR);
            $pdo->bindParam(":nombreApellido", $datosBeneficiarioActualizar["nombreApellido"], PDO::PARAM_STR);
            $pdo->bindParam(":fnacimiento", $datosBeneficiarioActualizar["fnacimiento"], PDO::PARAM_STR);
            $pdo->bindParam(":direccion", $datosBeneficiarioActualizar["direccion"], PDO::PARAM_STR);
            $pdo->bindParam(":celular", $datosBeneficiarioActualizar["celular"], PDO::PARAM_STR);
            $pdo->bindParam(":telefono", $datosBeneficiarioActualizar["telefono"], PDO::PARAM_STR);
            $pdo->bindParam(":referencia", $datosBeneficiarioActualizar["referencia"], PDO::PARAM_STR);

            $pdo->bindParam(":tipoMedio", $datosBeneficiarioActualizar["tipoMedio"], PDO::PARAM_STR);

            $pdo->bindParam(":estadoMedio", $datosBeneficiarioActualizar["estadoMedio"], PDO::PARAM_STR);

            $pdo->bindParam(":apoyoMedio", $datosBeneficiarioActualizar["apoyoMedio"], PDO::PARAM_STR);

            $pdo->bindParam(":diagnostico", $datosBeneficiarioActualizar["diagnostico"], PDO::PARAM_STR);
            $pdo->bindParam(":foto", $datosBeneficiarioActualizar["foto"], PDO::PARAM_STR);
            $pdo->bindParam(":nombreTutor", $datosBeneficiarioActualizar["nombreTutor"], PDO::PARAM_STR);
            $pdo->bindParam(":cedula", $datosBeneficiarioActualizar["cedula"], PDO::PARAM_STR);
            $pdo->bindParam(":parentesco", $datosBeneficiarioActualizar["parentesco"], PDO::PARAM_STR);
            $pdo->bindParam(":factualizacion", $datosBeneficiarioActualizar["factualizacion"], PDO::PARAM_STR);

            return ($pdo->execute()?true:false);
        } catch (exception $ex) {
            echo 'error: '.$ex->getMessage();
        }
    }

    // funcion para desactivar o dar de baja al beneficiario.
    public static function desactivarBeneficiarioM($datosDesactivarBeneficiario){
        try {
            $pdo = conexionBD::conexion()->prepare("UPDATE catbeneficiario SET 
            fechaBaja = :fechaBaja
            WHERE id=:id");

            $pdo->bindparam(":id",$datosDesactivarBeneficiario["id"],PDO::PARAM_INT);
            $pdo->bindparam(":fechaBaja", $datosDesactivarBeneficiario["fechaBaja"], PDO::PARAM_STR);

            return ($pdo->execute()?true:false);

        } catch (exception $ex) {
            echo 'error '.$ex->getMessage();
        }
    }

    // funcion para activar al beneficiario.
    public static function activarBeneficiarioM($codigoBeneficiario)
    {
        try {
            $pdo = conexionBD::conexion()->prepare("UPDATE catbeneficiario SET 
            fechaBaja = NULL
            WHERE id=:id");

            $pdo->bindparam(":id", $codigoBeneficiario, PDO::PARAM_INT);

            return ($pdo->execute() ? true : false);

        } catch (exception $ex) {
            echo 'error ' . $ex->getMessage();
        }
    }

    public static function beneficiarioAtendido($datosBeneficiarioAtendido){
        try {
            $pdo = conexionBD::conexion()->prepare("UPDATE catbeneficiario SET 
            fechaAtendidos = :fechaAtencion
            WHERE id=:id");

            $pdo->bindparam(":id", $datosBeneficiarioAtendido["id"], PDO::PARAM_INT);
            $pdo->bindparam(":fechaAtencion", $datosBeneficiarioAtendido["fechaAtendido"], PDO::PARAM_STR);

            if($pdo->execute()) {
                $obtenerDatosBeneficiarioAtendido = beneficiariosM::obtenerDatosBeneficiarioM($datosBeneficiarioAtendido["id"]);
                return $obtenerDatosBeneficiarioAtendido;
            } else {
                return false;
            }

        } catch (exception $ex) {
            echo 'error '. $ex->getMessage();
        }
    }
}