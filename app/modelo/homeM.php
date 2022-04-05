<?php
namespace app\modelo;
use app\modelo\conexionBD;
use Exception;

require_once 'conexionBD.php';
class homeM extends conexionBD{
    public static function dashboardTotalBeneficiarioRegistradoM(){
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT count(id) as total FROM catbeneficiario");
            //if ($pdo->execute()) {
                return (($pdo->execute()) ? $pdo->fetch():$pdo->execute());
            //}
        } catch (Exception $ex) {
            echo 'Error -'.$ex;
        }
    }
    
    Public static function dashboardUsuariosM(){
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT count(id) as total FROM usuarios");

            //if ($pdo->execute()) {
                return (($pdo->execute()) ? $pdo->fetch():$pdo->execute());
            //}
        } catch (exception $ex) {
            echo 'Error -'.$ex;
        }
    }

    public static function dashboardBeneficiarioPorEdad(){
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT count(id) as total, TIMESTAMPDIFF(YEAR,fnacimiento,CURDATE()) AS edad FROM catbeneficiario group by edad ");

            //if ($pdo->execute()) {
                return (($pdo->execute()) ? $pdo->fetchAll():$pdo->execute());
            //}
        } catch (exception $ex) {
            echo 'Error -'.$ex;
        }
    }

    // public static function dashboardUsuariosAdministradoresM(){
    //     try {
    //         $pdo = conexionBD::conexion()->prepare("SELECT count(id) as total FROM usuarios WHERE rolid = 1");

    //         //if ($pdo->execute()) {
    //             return (($pdo->execute()) ? $pdo->fetch():$pdo->execute());
    //         //}
    //     } catch (exception $ex) {
    //         echo 'Error -'.$ex;
    //     }
    // }

    public static function dashboardCantidadPorDiscapacidad(){
        try {
            $query = "SELECT diagnostico, count(id) as total FROM catbeneficiario group by diagnostico";
            $pdo = conexionBD::conexion()->prepare($query);

            //if ($pdo->execute()) {
                return (($pdo->execute()) ? $pdo->fetchAll(): $pdo->execute());
            //}
        } catch (exception $ex) {
            // echo '<script>Console.log("Error -'.print($ex->getMessage()).'");</script>';
            return false;
        }
    }
}
?>