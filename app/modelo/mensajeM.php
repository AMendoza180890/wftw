<?php
require_once "conexionBD.php";
class mensajeM extends conexionBD{

    static public function listademensajeM(){
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT `id`, `nombres`, `apellidos`, `telefono`, `email`, `tipoVoluntario`, `nombreLiderGrupo`, `comentario` FROM `catmensajes`");
            
            $pdo -> execute();
            return $pdo->fetchAll();

        } catch (exception $ex) {
            echo 'error - '.$ex;
        }
    }
}
