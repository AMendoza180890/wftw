<div class="modal fade" role="dialog" id="editarbeneficiario">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                    <h3>Informacion Beneficiario</h3>
                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <h2>Foto:</h2>
                            <img src="app/vista/img/beneficiario/defecto.png" alt="imagen" class="img-thumbnail visor" width="100px;">
                        </div>

                        <div class="form-group">
                            <h2>Nombre y Apellido:</h2>
                            <input type="text" class="form-control input-lg" name="nombreApelidoEdit" id="nombreApelidoEdit" disabled>
                            <input type="hidden" name="idedit" id="idedit">
                        </div>

                        <div class="form-group">
                            <h2>Fecha Nacimiento:</h2>
                            <input type="date" class="form-control input-lg" name="fnacimientoEdit" id="fnacimientoEdit" disabled>
                        </div>

                        <div class="form-group">
                            <h2>Edad</h2>
                            <input type="text" class="form-control input-lg" name="edadEdit" id="edadEdit" disabled>
                        </div>

                        <div class="form-group">
                            <h2>Direccion:</h2>
                            <input type="text" class="form-control input-lg" name="direccionEdit" id="direccionEdit" disabled>
                        </div>

                        <div class="form-group">
                            <h2>Referido por:</h2>
                            <input type="text" class="form-control input-lg" name="referidoEdit" id="referidoEdit" disabled>
                        </div>

                        <div class="form-group">
                            <h2>Tipo de Medio </h2>
                            <small id="helpcontent" class="form-text text-muted">(Describe el tipo de medio que usa actualmente)</small>
                            <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" disabled> -->
                            <select class="form-control input-lg" name="tMedioEdit" id="tMedioEdit" disabled>
                                <option id="tMedioValue"></option>
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
                            <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" disabled> -->
                            <select class="form-control input-lg" name="eMedioEdit" id="eMedioEdit" disabled>
                                <option id="eMedioValue"></option>
                                <option value="No Tengo">No Tengo</option>
                                <option value="Mal estado">Mal estado</option>
                                <option value="Problema con Medidas">Problema con Medidas</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>Nivel de apoyo </h2>
                            <small id="helpcontent" class="form-text text-muted">(Describe el nivel de apoyo que necesita con el medio)</small>
                            <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" disabled> -->
                            <select class="form-control input-lg" name="nApoyoEdit" id="nApoyoEdit" disabled>
                                <option id="nApoyoValue"></option>
                                <option value="No Aplica">No Aplica</option>
                                <option value="Ninguno">Ninguno</option>
                                <option value="Total">Total</option>
                                <option value="Parcial">Parcial</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>Diagnostico</h2>
                            <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" disabled> -->
                            <select class="form-control input-lg" name="diagnosticoEdit" id="diagnosticoEdit" disabled>
                                <option id="diagValor"></option>
                                <option value="Sindrome Down">Sindrome Down</option>
                                <option value="Paralisis Cerebral">Paralisis Cerebral</option>
                                <option value="TEA">TEA (Transtorno del Espectro Autista)</option>
                                <option value="Deficit Intelectual">Deficit Intelectual</option>
                                <option value="Hidrocefalia">Hidrocefalia</option>
                                <option value="Microcefalia">Microcefalia</option>
                                <option value="Dislexia">Dislexia</option>
                                <option value="Trastorno de Lenguaje">Trastorno de Lenguaje</option>
                                <option value="TDAH">TDAH</option>
                                <option value="Esquizofrenia">Esquizofrenia</option>
                                <option value="TOC">TOC (Transtorno Obcesivo Compulsivo)</option>
                            </select>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <h3>Familiar o Tutor</h3>
                    </div>

                    <div class="form-group">
                        <h2>Nombre y Apellido</h2>
                        <input type="text" class="form-control input-lg" name="tutornombreEdit" id="tutornombreEdit" disabled>
                    </div>

                    <div class="form-group">
                        <h2>Celular:</h2>
                        <input type="text" class="form-control input-lg" name="celularEdit" id="celularEdit" disabled>
                    </div>

                    <div class="form-group">
                        <h2>Telefono Convencional:</h2>
                        <input type="text" class="form-control input-lg" name="telefonoEdit" id="telefonoEdit" disabled>
                    </div>

                    <div class="form-group">
                        <h2>Cedula:</h2>
                        <input type="text" class="form-control input-lg" name="tutorcedulaEdit" id="tutorcedulaEdit" disabled>
                    </div>

                    <div class="form-group">
                        <h2>Parentesco:</h2>
                        <!-- <input type="text" class="form-control input-lg" name="direccion" id="direccion" disabled> -->
                        <select class="form-control input-lg" name="tutorparentescoEdit" id="tutorparentescoEdit" disabled>
                            <option id="tutorValor"></option>
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
                        <select class="form-control input-lg" name="institucionEdit" id="institucionEdit" disabled>
                            <option id="institucionValor"></option>
                            <option value="Tesoros de Dios">Tesoros de Dios</option>
                            <option value="Asambleas de Dios">Asambleas de Dios</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>