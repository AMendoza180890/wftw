<?php
namespace app\modelo;
class envConexion{
      private $datos;
      public function __construct()
      {
            // en variables
            //  $DATABASENAME = "tesorosd_bdtogether";
            //  $SERVIDOR = "localhost";
            //  $USER = "tesorosd_admint";
            //  $PASSW = "3kaBZmmJ90zR";
      
            //conexion en local
            $this->datos = array("DATABASENAME" => "bdtogether", 'SERVIDOR' => "localhost", 'USER' => "root", 'PASSW' =>"");
      }

      public function varEntorno(){
            return $this->datos;
      }
}
?>