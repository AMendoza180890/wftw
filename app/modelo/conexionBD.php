<?php
namespace app\modelo;
require_once '../wftw/vendor/autoload.php';
use Exception;
use PDO;
// require_once ('envConexion.php');
class conexionBD{
    public static function conexion(){
        try {
            $variables = new envConexion();
            $bd = new PDO("mysql:host=".$variables->datos["SERVIDOR"].";dbname=". $variables->datos["DATABASENAME"], $variables->datos["USER"], $variables->datos["PASSW"]);
            $bd -> exec("set names utf8");

            return $bd;
        } catch (Exception $ex) {
            echo 'error - '.$ex;
        }
    }
}
?>