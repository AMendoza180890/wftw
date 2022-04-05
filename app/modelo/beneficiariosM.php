<?php

namespace app\modelo;

use app\modelo\conexionBD;
use Exception;
use PDO;

//require_once 'conexionBD.php';
class beneficiariosM extends conexionBD
{

    public static function mostrarListaBeneficiarioM()
    {
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT id, nombreApellido, fnacimiento, direccion, celular, telefono, referencia, diagnostico, foto, nombreTutor, cedula, parentesco FROM catbeneficiario");
            $pdo->execute();
            return $pdo->fetchAll();
        } catch (Exception $ex) {
            echo 'error: ' . $ex->getMessage();
        }
    }

    public static function datosGuardarBeneficiarioM($datoBeneficiario)
    {
        try {
            $pdo = conexionBD::conexion()->prepare("INSERT INTO catbeneficiario(nombreApellido, fnacimiento, direccion, celular, telefono, referencia, diagnostico, foto, nombreTutor, cedula, parentesco) VALUES (:nombreApellido, :fnacimiento, :direccion, :celular, :telefono, :referencia, :diagnostico, :foto, :nombreTutor, :cedula, :parentesco)");

            $pdo->bindParam(":nombreApellido", $datoBeneficiario["nombreApellido"], PDO::PARAM_STR);
            $pdo->bindParam(":fnacimiento", $datoBeneficiario["fnacimiento"], PDO::PARAM_STR);
            $pdo->bindParam(":direccion", $datoBeneficiario["direccion"], PDO::PARAM_STR);
            $pdo->bindParam(":celular", $datoBeneficiario["celular"], PDO::PARAM_STR);
            $pdo->bindParam(":telefono", $datoBeneficiario["telefono"], PDO::PARAM_STR);
            $pdo->bindParam(":referencia", $datoBeneficiario["referencia"], PDO::PARAM_STR);
            $pdo->bindParam(":diagnostico", $datoBeneficiario["diagnostico"], PDO::PARAM_STR);
            $pdo->bindParam(":foto", $datoBeneficiario["foto"], PDO::PARAM_STR);
            $pdo->bindParam(":nombreTutor", $datoBeneficiario["nombreTutor"], PDO::PARAM_STR);
            $pdo->bindParam(":cedula", $datoBeneficiario["cedula"], PDO::PARAM_STR);
            $pdo->bindParam(":parentesco", $datoBeneficiario["parentesco"], PDO::PARAM_STR);

            return ($pdo->execute()?true:false);

        } catch (exception $ex) {
            echo 'error: ' . $ex->getMessage();
        }
    }

    public static function obtenerDatosBeneficiarioM($valor){
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT id, nombreApellido, fnacimiento, direccion, celular, telefono, referencia, diagnostico, foto, nombreTutor, cedula, parentesco FROM catbeneficiario WHERE id = :id");

            $pdo -> bindParam(":id",$valor,PDO::PARAM_INT);
            $pdo->execute();
            return $pdo->fetch();
        } catch (exception $ex) {
            echo 'error: '.$ex->getMessage();
        }
    }

    public static function actualizarDatosBeneficiarioM($datosBeneficiarioActualizar){
        try {
            
            $pdo = conexionBD::conexion()->prepare("UPDATE catbeneficiario SET 
            nombreApellido=:nombreApellido,
            fnacimiento=:fnacimiento,
            direccion=:direccion,
            celular=:celular,
            telefono=:telefono,
            referencia=:referencia,
            diagnostico=:diagnostico,
            foto=:foto,
            nombreTutor=:nombreTutor,
            cedula=:cedula,
            parentesco=:parentesco
            WHERE id=:id");

            $pdo->bindParam(":id", $datosBeneficiarioActualizar["id"], PDO::PARAM_STR);
            $pdo->bindParam(":nombreApellido", $datosBeneficiarioActualizar["nombreApellido"], PDO::PARAM_STR);
            $pdo->bindParam(":fnacimiento", $datosBeneficiarioActualizar["fnacimiento"], PDO::PARAM_STR);
            $pdo->bindParam(":direccion", $datosBeneficiarioActualizar["direccion"], PDO::PARAM_STR);
            $pdo->bindParam(":celular", $datosBeneficiarioActualizar["celular"], PDO::PARAM_STR);
            $pdo->bindParam(":telefono", $datosBeneficiarioActualizar["telefono"], PDO::PARAM_STR);
            $pdo->bindParam(":referencia", $datosBeneficiarioActualizar["referencia"], PDO::PARAM_STR);
            $pdo->bindParam(":diagnostico", $datosBeneficiarioActualizar["diagnostico"], PDO::PARAM_STR);
            $pdo->bindParam(":foto", $datosBeneficiarioActualizar["foto"], PDO::PARAM_STR);
            $pdo->bindParam(":nombreTutor", $datosBeneficiarioActualizar["nombreTutor"], PDO::PARAM_STR);
            $pdo->bindParam(":cedula", $datosBeneficiarioActualizar["cedula"], PDO::PARAM_STR);
            $pdo->bindParam(":parentesco", $datosBeneficiarioActualizar["parentesco"], PDO::PARAM_STR);

            return ($pdo->execute()?true:false);
        } catch (exception $ex) {
            echo 'error: '.$ex->getMessage();
        }
    }
}