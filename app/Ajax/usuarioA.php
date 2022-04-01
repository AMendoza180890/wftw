<?php

use app\controlador\usuariosC;
use app\modelo\usuariosM;
use app\modelo\conexionBD;
use app\modelo\envConexion;

require_once '../modelo/conexionBD.php';
require_once '../controlador/usuariosC.php';
require_once '../modelo/usuariosM.php';
require_once '../modelo/envConexion.php';
// require_once '../controlador/rolesC.php';
// require_once '../modelo/rolesM.php';

class usuariosAjax{
    public $id;

    public function usuarioEditA(){
        $valor = $this->id;
        $editarUsuario = usuariosC::editarRegistroUsuarioC($valor);
        echo json_encode($editarUsuario);
    }
}

if (isset($_POST["id"])) {
    $editarUsuario = new usuariosAjax;
    $editarUsuario -> id = $_POST["id"];
    $editarUsuario -> usuarioEditA();
    // usuariosAjax::setRolEditA($_POST["id"]);
}

?>