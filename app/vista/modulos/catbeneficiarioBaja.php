<!-- pagina para mostrar los beneficiarios en lista, los que vayan registrandose -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Beneficiarios dados de Baja
    </h1>
    <small id="helpcontent" class="form-text text-muted">(Muestra lista de los beneficiarios dados de baja, puedes darles de alta)</small>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <!-- <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#crearBeneficiario">Ingrear Beneficiario</button>
      </div> -->
      <div class="box-body">
        <table class="table table-bordered table-hover table-striped TablaUsuario" id="tbl">
          <thead>
            <tr>
              <th>Nº</th>
              <th>Nombre Completo</th>
              <th>Fecha Baja</th>
              <th>Diagnostico</th>
              <th>Cedula</th>
              <th>Telefono</th>
              <th>Nombre Tutor</th>
              <th>Activar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            use app\controlador\beneficiariosC;
            $mostrarBeneficiarios = new beneficiariosC;
            $mostrarBeneficiarios -> mostrarListaBeneficiarioBajaC();
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
<?php
$activarBeneficiario = new beneficiariosC();
$activarBeneficiario -> activarBeneficiarioC();
?>