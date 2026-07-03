<?php

require __DIR__ . '/app/bootstrap.php';

use app\controlador\plantillaC as VistaPlantillaAdminLteC;

$plantilla = new VistaPlantillaAdminLteC();
$plantilla->llamarPlantillaAdminLte();
