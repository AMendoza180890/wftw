<?php
use app\controlador\authC;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Volunteer | Administracion</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="app/vista/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="app/vista/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="app/vista/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="app/vista/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="app/vista/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-2.2.2/datatables.min.css" integrity="sha384-2vMryTPZxTZDZ3GnMBDVQV8OtmoutdrfJxnDTg0bVam9mZhi7Zr3J1+lkVFRr71f" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini login-page">
<?php
if (isset($_SESSION['ingreso']) && $_SESSION['ingreso'] == true) {
    echo '<div class="wrapper">';
    include 'modulos/cabecera.php';
    include 'modulos/menu.php';
    include 'modulos/rutasAdmin.php';
    if (isset($_GET['ruta']) && isset($rutasAdmin[$_GET['ruta']])) {
        include 'modulos/' . $_GET['ruta'] . '.php';
    } else {
        include 'modulos/inicio.php';
    }
    echo '</div>';
} else {
    include 'modulos/login.php';
}
?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEv8FF1zOHTlWzRg=" crossorigin="anonymous"></script>
<script src="app/vista/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.2.2/datatables.min.js" integrity="sha384-2Ul6oqy3mEjM7dBJzKOck1Qb/mzlO+k/0BQv3D3C7u+Ri9+7OBINGa24AeOv5rgu" crossorigin="anonymous"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="app/vista/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="app/vista/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="app/vista/bower_components/fastclick/lib/fastclick.js"></script>
<script src="app/vista/dist/js/adminlte.min.js"></script>
<?php if (isset($_SESSION['ingreso']) && $_SESSION['ingreso'] == true) { ?>
<script>window.WFTW_CSRF = <?php echo json_encode(authC::csrfToken()); ?>;</script>
<script src="app/vista/js/usuario.js"></script>
<script src="app/vista/js/beneficiario.js"></script>
<?php } ?>
<script>
  $(function () {
    if ($('#tbl').length) {
      $('#tbl').DataTable({
        lengthMenu: [[100, 50, 25, 10, -1], [100, 50, 25, 10, 'Todos']],
        language: {
          url: 'https://cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json'
        }
      });
    }
  });
</script>
</body>
</html>
