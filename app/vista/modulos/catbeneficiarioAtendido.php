<!-- pagina para mostrar los beneficiarios en lista, los que vayan registrandose -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Beneficiarios Atendidos
    </h1>
    <small id="helpcontent" class="form-text text-muted">(Muestra la lista de los beneficiarios atendidos, puedes ver detalles de los beneficiarios)</small>
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
              <th>Fecha Atendido</th>
              <th>Diagnostico</th>
              <th>Cedula</th>
              <th>Telefono</th>
              <th>Nombre Tutor</th>
              <th>Ver Detalles</th>
            </tr>
          </thead>
          <tbody>
            <?php
            use app\controlador\beneficiariosC;
            $mostrarBeneficiarios = new beneficiariosC;
            $mostrarBeneficiarios -> mostrarListaBeneficiarioAtendidosC();
            $valor = null;
            $showInfBeneficiarioAtendido = beneficiariosC::obtenerDatosBeneficiarioC($valor);
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
<?php include 'showbeneficiarioInfo.php'; ?>