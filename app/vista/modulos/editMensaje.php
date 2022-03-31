<div class="modal fade" role="dialog" id="editarseccion">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <li class="fa fa-time"></li>
                    </button>
                    <h3>Editar Articulo</h3>
                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <h2>Titulo</h2>
                            <input type="text" class="form-control input-lg" name="tituloEdit" id="tituloEdit" required>
                            <input type="hidden" name="idEdit" id="idEdit">
                        </div>

                        <div class="form-group">
                            <h2>Descripcion corta</h2>
                            <input type="text" class="form-control input-lg" name="descripCortaEdit" id="descripCortaEdit" required>
                        </div>

                        <div class="form-group">
                            <h2>Descripcion Larga</h2>
                            <textarea class="form-control input-lg" name="descripLargaEdit" id="descripLargaEdit" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <h2>Foto:</h2>
                            <input type="file" name="fotoEdit" id="fotoEdit">
                            <p class="help-block">peso maximo permitido 200 Mb</p>
                            <img src="vista/img/usuario/defecto.png" alt="imagen" class="img-thumbnail visor" width="100px;">
                            <input type="hidden" name="fotoActual" id="fotoActual">
                        </div>

                        <div class="form-group">
                            <h2>Estado</h2>
                            <select name="estadoEdit" class="form-control input-lg">
                                <option id="estadoEdit"></option>
                                <option value="1">Activo</option>
                                <option value="2">Desactivo</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>URL</h2>
                            <input type="text" class="form-control input-lg" name="urlEdit" id="urlEdit" required>
                        </div>

                        <div class="form-group">
                            <h2>Cantidad</h2>
                            <input type="text" class="form-control input-lg" name="cantidadEdit" id="cantidadEdit">
                        </div>

                        <div class="form-group">
                            <h2>Costo</h2>
                            <input type="text" class="form-control input-lg" name="costoEdit" id="costoEdit">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
                <?php
                $actualizarseccion  =   new seccionC();
                $actualizarseccion -> actualizarRegistroseccionC();
                ?>
            </form>
        </div>
    </div>
</div>