<!-- pop up crear beneficiario -->
<div class="modal fade" role="dialog" id="crearBeneficiario">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <?php
                use app\controlador\authC;
                echo authC::csrfField();
                ?>
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
                            <h2>Edad:</h2>
                            <input type="text" class="form-control input-lg" id="edad" disabled>
                        </div>

                        <div class="form-group">
                            <h2>Direccion:</h2>
                            <input type="text" class="form-control input-lg" name="direccion" id="direccion" required>
                        </div>

                        <div class="form-group">
                            <h2>Referido por:</h2>
                            <input type="text" class="form-control input-lg" name="referido" id="referido" required>
                        </div>

                        <div class="form-group">
                            <h2>Tipo de Medio </h2>
                            <small id="helpcontent" class="form-text text-muted">(Describe el tipo de medio que usa actualmente)</small>
                            <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" required> -->
                            <select class="form-control input-lg" name="tMedio" id="tMedio" required>
                                <option value="No Tengo">No Tengo</option>
                                <option value="Silla de Ruedas">Silla de Ruedas</option>
                                <option value="Baston">Baston</option>
                                <option value="Andarivel">Andarivel</option>
                                <option value="Muletas">Muletas</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>Estado del de Medio </h2>
                            <small id="helpcontent" class="form-text text-muted">(Describe el estado del Medio Auxiliar)</small>
                            <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" required> -->
                            <select class="form-control input-lg" name="eMedio" id="eMedio" required>
                                <option value="No Tengo">No Tengo</option>
                                <option value="Mal estado">Mal estado</option>
                                <option value="Problema con Medidas">Problema con Medidas</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>Nivel de apoyo </h2>
                            <small id="helpcontent" class="form-text text-muted">(Describe el nivel de apoyo que necesita con el medio)</small>
                            <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" required> -->
                            <select class="form-control input-lg" name="nApoyo" id="nApoyo" required>
                                <option value="No Aplica">No Aplica</option>
                                <option value="Ninguno">Ninguno</option>
                                <option value="Total">Total</option>
                                <option value="Parcial">Parcial</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>Diagnostico</h2>
                            <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" required> -->
                            <select class="form-control input-lg" name="diagnostico" id="diagnostico">
                                <option value="Sindrome Down">Sindrome Down</option>
                                <option value="Paralisis Cerebral">Paralisis Cerebral</option>
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
                        <h2>Celular:</h2>
                        <input type="text" class="form-control input-lg" name="celular" id="celular" required>
                    </div>

                    <div class="form-group">
                        <h2>Telefono Convencional:</h2>
                        <input type="text" class="form-control input-lg" name="telefono" id="telefono" required>
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

                    <div class="form-group">
                        <h2>Institucion:</h2>
                        <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" required> -->
                        <select class="form-control input-lg" name="institucion" id="institucion">
                            <option value="Tesoros de Dios">Tesoros de Dios</option>
                            <option value="Asambleas de Dios">Asambleas de Dios</option>
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