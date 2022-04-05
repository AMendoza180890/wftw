<!-- pop up crear beneficiario -->
<div class="modal fade" role="dialog" id="crearBeneficiario">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <li class="fa fa-time"></li>
                    </button>
                    <h3>Registrar Beneficiario</h3>
                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <h2>Nombre y Apellido:</h2>
                            <input type="text" class="form-control input-lg" name="nombreApelido" id="nombreApelido" required>
                        </div>

                        <div class="form-group">
                            <h2>Fecha Nacimiento:</h2>
                            <input type="date" class="form-control input-lg" name="fnacimiento" id="fnacimiento" required>
                        </div>

                        <div class="form-group">
                            <h2>Direccion:</h2>
                            <input type="text" class="form-control input-lg" name="direccion" id="direccion" required>
                        </div>

                        <div class="form-group">
                            <h2>Celular:</h2>
                            <input type="text" class="form-control input-lg" name="celular" id="celular" required>
                        </div>

                        <div class="form-group">
                            <h2>Telefono Convencional:</h2>
                            <input type="text" class="form-control input-lg" name="telefono" id="telefono" required>
                        </div>

                        <div class="form-group">
                            <h2>Referido por:</h2>
                            <input type="text" class="form-control input-lg" name="referido" id="referido" required>
                        </div>

                        <div class="form-group">
                            <h2>Diagnostico</h2>
                            <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" required> -->
                            <select class="form-control input-lg" name="diagnostico" id="diagnostico">
                                <option value="diagnostico1">diagnostico1</option>
                                <option value="diagnostico2">diagnostico2</option>
                                <option value="diagnostico3">diagnostico3</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>Foto:</h2>
                            <input type="file" name="fotoNuevo" id="fotoNuevo">
                            <p class="help-block">peso maximo permitido 200 Mb</p>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <h3>Familiar o Tutor</h3>
                    </div>

                    <div class="form-group">
                        <h2>Nombre y Apellido</h2>
                        <input type="text" class="form-control input-lg" name="tutornombre" id="tutornombre" required>
                    </div>

                    <div class="form-group">
                        <h2>Cedula:</h2>
                        <input type="text" class="form-control input-lg" name="tutorcedula" id="tutorcedula" required>
                    </div>

                    <div class="form-group">
                        <h2>Parentesco:</h2>
                        <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" required> -->
                        <select class="form-control input-lg" name="tutorparentesco" id="tutorparentesco">
                            <option value="padre">padre</option>
                            <option value="madre">madre</option>
                            <option value="abuelo">abuelo</option>
                            <option value="tio">tio</option>
                            <option value="hermano">hermano</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php

use app\controlador\beneficiariosC;

 $insertarBeneficiario  = new beneficiariosC();
 $insertarBeneficiario->datosGuardarBeneficiarioC();
?>