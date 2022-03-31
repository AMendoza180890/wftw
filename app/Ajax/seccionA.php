<?php
require_once '../controlador/seccionC.php';
require_once '../modelo/seccionM.php';

class seccionAjax{
    public $id;

    public function seccionEditA(){
        $valor = $this->id;
        $editarUsuario = seccionC::editarRegistroseccionC($valor);
        echo json_encode($editarUsuario);
    }
}

if (isset($_POST["id"])) {
    $obtenerSeccion = new seccionAjax;
    $obtenerSeccion -> id = $_POST["id"];
    $obtenerSeccion -> seccionEditA();
}
