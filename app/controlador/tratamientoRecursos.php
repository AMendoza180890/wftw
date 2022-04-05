<?php

namespace app\controlador;
require_once '../../vendor/autoload.php';
use Exception;

class tratamientoRecursos {
    public static function tratamientoTipoImagenBeneficiario($nombreElemento, $elemento)
    {
        try {
            $rutaImagen = "";
            if (isset($nombreElemento) && !empty($nombreElemento)) {
                if ($elemento["type"] == "image/jpeg") {
                    $nombreImagen = mt_rand(10, 999);
                    $rutaImagen = "app/vista/img/beneficiario/b" . $nombreImagen . ".jpg";
                    $foto = imagecreatefromjpeg($nombreElemento);
                    imagejpeg($foto, $rutaImagen);
                }
                if ($elemento["type"] == "image/png") {
                    $nombreImagen = mt_rand(10, 999);
                    $rutaImagen = "app/vista/img/beneficiario/b" . $nombreImagen . ".png";
                    $foto = imagecreatefrompng($nombreElemento);
                    imagepng($foto, $rutaImagen);
                }
                return $rutaImagen;
            } else {
                return $rutaImagen;
            }
        } catch (Exception $ex) {
            echo 'Error - ' . $ex;
        }
    }
}
?>