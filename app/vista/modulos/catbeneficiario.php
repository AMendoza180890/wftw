<!-- pagina para mostrar los beneficiarios en lista, los que vayan registrandose -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Beneficiarios
    </h1>
    <small id="helpcontent" class="form-text text-muted">(Puedes agregar, editar y consultar la informacion de los Beneficiarios)</small>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#crearBeneficiario">Ingrear Beneficiario</button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-hover table-striped TablaUsuario" id="tbl">
          <thead>
            <tr>
              <th>Nº</th>
              <th>Nombre Completo</th>
              <th>FNacimiento</th>
              <th>Diagnostico</th>
              <th>Cedula</th>
              <th>Telefono</th>
              <th>Nombre Tutor</th>
              <th>Editar/Desactivar</th>
            </tr>
          </thead>
          <tbody>
            <?php

            use app\controlador\beneficiariosC;

            $mostrarBeneficiarios = new beneficiariosC;
            $mostrarBeneficiarios -> mostrarListaBeneficiarioC();

            // $valor = null;
            // $editarUsuario = usuariosC::editarRegistroUsuarioC($valor);
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
<?php include 'crearbeneficiario.php'; ?>
<?php include 'editbeneficiario.php'; ?>