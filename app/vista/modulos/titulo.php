<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Titulo y Descripción
    </h1>
    <small id="helpcontent" class="form-text text-muted">(Edita el Titulo y la Descripcion de la página de campaña)</small>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#editarAyuda">Editar Encabezado</button>
      </div>
      <div class="box-body">
        <?php
            $vertitulo = new tituloController();
            $vertitulo->mostrartituloC();
        ?>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'editTitulo.php'; ?>
<?php //include 'editarRecurso.php'; 
?>