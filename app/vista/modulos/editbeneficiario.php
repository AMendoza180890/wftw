<div class="modal fade" role="dialog" id="editarbeneficiario">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <li class="fa fa-time"></li>
                    </button>
                    <h3>Editar Informacion Beneficiario</h3>
                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <h2>Nombre y Apellido:</h2>
                            <input type="text" class="form-control input-lg" name="nombreApelidoEdit" id="nombreApelidoEdit" required>
                            <input type="hidden" name="idedit" id="idedit">
                        </div>

                        <div class="form-group">
                            <h2>Fecha Nacimiento:</h2>
                            <input type="date" class="form-control input-lg" name="fnacimientoEdit" id="fnacimientoEdit" required>
                        </div>

                        <div class="form-group">
                            <h2>Direccion:</h2>
                            <input type="text" class="form-control input-lg" name="direccionEdit" id="direccionEdit" required>
                        </div>

                        <div class="form-group">
                            <h2>Celular:</h2>
                            <input type="text" class="form-control input-lg" name="celularEdit" id="celularEdit" required>
                        </div>

                        <div class="form-group">
                            <h2>Telefono Convencional:</h2>
                            <input type="text" class="form-control input-lg" name="telefonoEdit" id="telefonoEdit" required>
                        </div>

                        <div class="form-group">
                            <h2>Referido por:</h2>
                            <input type="text" class="form-control input-lg" name="referidoEdit" id="referidoEdit" required>
                        </div>

                        <div class="form-group">
                            <h2>Diagnostico</h2>
                            <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" required> -->
                            <select class="form-control input-lg" name="diagnosticoEdit" id="diagnosticoEdit">
                                <option id="diagValor"></option>
                                <option value="diagnostico1">diagnostico1</option>
                                <option value="diagnostico2">diagnostico2</option>
                                <option value="diagnostico3">diagnostico3</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>Foto:</h2>
                            <input type="file" name="fotoNuevoEdit" id="fotoNuevoEdit">
                            <img src="app/vista/img/beneficiario/defecto.png" alt="imagen" class="img-thumbnail visor" width="100px;">
                            <input type="hidden" name="fotoActual" id="fotoActual">
                            <p class="help-block">peso maximo permitido 200 Mb</p>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <h3>Familiar o Tutor</h3>
                    </div>

                    <div class="form-group">
                        <h2>Nombre y Apellido</h2>
                        <input type="text" class="form-control input-lg" name="tutornombreEdit" id="tutornombreEdit" required>
                    </div>

                    <div class="form-group">
                        <h2>Cedula:</h2>
                        <input type="text" class="form-control input-lg" name="tutorcedulaEdit" id="tutorcedulaEdit" required>
                    </div>

                    <div class="form-group">
                        <h2>Parentesco:</h2>
                        <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" required> -->
                        <select class="form-control input-lg" name="tutorparentescoEdit" id="tutorparentescoEdit">
                            <option id ="tutorValor"></option>
                            <option value="padre">padre</option>
                            <option value="madre">madre</option>
                            <option value="abuelo">abuelo</option>
                            <option value="tio">tio</option>
                            <option value="hermano">hermano</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>

            </form>
        </div>
    </div>
</div>
<?php

use app\controlador\beneficiariosC;

$actualizarAyuda  = new beneficiariosC();
$actualizarAyuda->actualizarDatosBeneficiario();
?>