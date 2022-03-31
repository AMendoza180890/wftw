<div class="modal fade" role="dialog" id="crearseccion">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <li class="fa fa-time"></li>
                    </button>
                    <h3>Agregar Articulo</h3>
                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <h2>Titulo</h2>
                            <input type="text" class="form-control input-lg" name="titulo" id="titulo" placeholder="Nombre del Articulo" required>
                        </div>

                        <div class="form-group">
                            <h2>Descripcion corta</h2>
                            <input type="text" class="form-control input-lg" name="descripcionCorta" id="descripcionCorta" placeholder="Descripción corta del articulo" required>
                        </div>

                        <div class="form-group">
                            <h2>Descripcion Larga</h2>
                            <textarea class="form-control input-lg" name="descripLarga" id="descripLarga" placeholder="Puedes describir un poco más sobre el articulo" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <h2>Foto:</h2>
                            <input type="file" name="foto" id="foto">
                            <p class="help-block">peso maximo permitido 200 Mb</p>
                            <img src="vista/img/usuario/default.png" alt="imagen" class="img-thumbnail visor" width="100px;">
                        </div>

                        <div class="form-group">
                            <h2>Estado</h2>
                            <select name="estado" class="form-control input-lg">
                                <option value="1">Activo</option>
                                <option value="2">Desactivo</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>URL</h2>
                            <input type="text" class="form-control input-lg" name="urlActual" id="urlActual" placeholder="https://www.kindful.com ej." required>
                        </div>

                        <div class="form-group">
                            <h2>Cantidad</h2>
                            <input type="text" class="form-control input-lg" name="cantidad" id="cantidad" placeholder="Escribe la cantidad que se necesita del articulo solo el nùmero ej. 20">
                        </div>

                        <div class="form-group">
                            <h2>Costo</h2>
                            <input type="text" class="form-control input-lg" name="costo" id="costo" placeholder="Escribe el costo del articulo, solo el número ej. 150">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
                <?php
                $crearSeccion  =   new seccionC();
                $crearSeccion->registrarseccionC();
                ?>
            </form>
        </div>
    </div>
</div>