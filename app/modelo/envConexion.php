<?php
namespace app\modelo;
class envConexion{
      public $datos;
      public function __construct()
      {
            // en variables
            //  $DATABASENAME = "tesorosd_bdtogether";
            //  $SERVIDOR = "localhost";
            //  $USER = "tesorosd_admint";
            //  $PASSW = "3kaBZmmJ90zR";
      
            //conexion en local
            $this->datos = array(
                  "DATABASENAME" => "bdwftw", 
                  'SERVIDOR' => "localhost", 
                  'USER' => "root", 
                  'PASSW' =>"");
      }
}
?>