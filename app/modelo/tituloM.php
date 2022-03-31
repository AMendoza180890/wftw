<?php

use app\modelo\conexionBD;

    //require_once 'conexionBD.php';
class tituloModel extends conexionBD{
    public static function mostrartituloM(){
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT id, titulo, descripcion FROM encabezadocampaign");
            $pdo -> execute();
            return $pdo->fetch();
        } catch (exception $ex) {
            echo 'error: '.$ex->getMessage();
        }
    }

    public static function actualizartituloM($infotitulo){
        try {
            $pdo = conexionBD::conexion()->prepare("UPDATE encabezadocampaign SET titulo=:titulo, descripcion=:descripcion WHERE id = 1");
            $pdo->bindParam(":titulo", $infotitulo["titulo"], PDO::PARAM_STR);
            $pdo->bindParam(":descripcion", $infotitulo["descripcion"], PDO::PARAM_STR);
            if($pdo->execute()){
                return true;
            }else {
                return false;
            }
        } catch (exception $ex) {
            echo 'error: '.$ex->getMessage();
        }
    }
}
