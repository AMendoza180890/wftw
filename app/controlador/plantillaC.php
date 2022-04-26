<?php
namespace app\controlador;
//require_once '../wftw/vendor/autoload.php';
use Exception;

class plantillaC{
    public function llamarPlantillaAdminLte(){
        try {
            //echo 'se imprime bien';
            include 'app/vista/plantilla.php';
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
?>