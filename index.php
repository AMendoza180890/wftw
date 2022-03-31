<?php
use app\controlador\plantillaC as VistaPlantillaAdminLteC;
require __DIR__ . '/vendor/autoload.php';

// include_once 'app/controlador/plantillaC.php';
// include_once 'app/controlador/usuariosC.php';
// include_once 'app/controlador/rolesC.php';
// include_once 'app/controlador/tratamientoImagen.php';
// include_once 'app/controlador/tratamientoRecursos.php';
// include_once 'app/controlador/homeC.php';
// // include_once 'controlador/tituloC.php';
// include_once 'app/controlador/mensajeC.php';

// include_once 'app/modelo/usuariosM.php';
// include_once 'app/modelo/rolesM.php';
// include_once 'app/modelo/homeM.php';
// // include_once 'modelo/tituloM.php';
// include_once 'app/modelo/mensajeM.php';

$plantilla = new VistaPlantillaAdminLteC;
$plantilla -> llamarPlantillaAdminLte();
?>