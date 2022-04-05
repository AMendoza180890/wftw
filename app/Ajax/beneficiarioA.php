<?php

use app\controlador\beneficiariosC;
use app\modelo\beneficiariosM;
use app\modelo\conexionBD;
use app\modelo\envConexion;

require_once '../modelo/conexionBD.php';
require_once '../modelo/envConexion.php';
require_once '../controlador/beneficiariosC.php';
require_once '../modelo/beneficiariosM.php';
// require_once '../controlador/rolesC.php';
// require_once '../modelo/rolesM.php';

class beneficiarioA{
    public $id;

    public function __construct()
    {
        if (isset($_POST["id"])) {
            $this->id = $_POST["id"];
        }
    }

    public function beneficiarioEditA(){
        $valor = $this->id;
        $datosObtenidosBeneficiarios = beneficiariosC::obtenerDatosBeneficiarioC($valor);
        echo json_encode($datosObtenidosBeneficiarios);
    }
}

// if (isset($_POST["id"])) {
//     $editarUsuario = new usuariosAjax;
//     $editarUsuario -> id = $_POST["id"];
//     $editarUsuario -> usuarioEditA();
//     // usuariosAjax::setRolEditA($_POST["id"]);
// }

            $recuperarDatosBeneficiario = new beneficiarioA;
            $recuperarDatosBeneficiario -> beneficiarioEditA();

?>