<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Gestor de Mensajes
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <!-- <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#crearseccion">Gestor de Mensajes</button>
      </div> -->
      <div class="box-body">
        <table class="table table-bordered table-hover table-striped TablaUsuario" id="tbl">
          <thead>
            <tr>
              <th>Nº</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>tipo Voluntario</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Comentarios</th>
              <th>Editar/Desactivar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $mostrarUsuarios = new mensajeC;
            $mostrarUsuarios->listademensaje();

            // $valor = null;
            // $editarUsuario = mensajeC::editarRegistroseccionC($valor);
            ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'crearMensaje.php'; ?>
<?php include 'editMensaje.php'; ?>
<?php
// $desactivarSeccion = new mensajeC;
// $desactivarSeccion -> desactivarMensaje();
?>