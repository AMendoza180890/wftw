<div class="modal fade" role="dialog" id="editarUsuario">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <?php
                use app\controlador\authC;
                echo authC::csrfField();
                ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                    <h3>Editar Usuarios</h3>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <h2>Usuario</h2>
                            <input type="text" class="form-control input-lg" name="usuarioEdit" id="usuarioEdit" required>
                            <input type="hidden" name="idEdit" id="idEdit">
                        </div>
                        <div class="form-group">
                            <h2>Nueva clave</h2>
                            <input type="password" class="form-control input-lg" name="claveEdit" id="claveEdit" placeholder="Dejar vacio para mantener la actual">
                        </div>
                        <div class="form-group">
                            <h2>Rol</h2>
                            <select name="rolEdit" id="rolEdit" class="form-control input-lg">
                                <option value="" hidden></option>
                                <option value="1">Administrador</option>
                                <option value="2">Invitado</option>
                                <option value="3">Desactivado</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <h2>Foto:</h2>
                            <input type="file" name="fotoEdit" id="fotoEdit">
                            <p class="help-block">Peso maximo permitido 2 MB</p>
                            <img src="app/vista/img/usuario/defecto.png" alt="imagen" class="img-thumbnail visor" width="100px;">
                            <input type="hidden" name="fotoActual" id="fotoActual">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
<?php
use app\controlador\usuariosC;
$actualizarUsuario  = new usuariosC();
$actualizarUsuario -> actualizarRegistroUsuarioC();
?>
            </form>
        </div>
    </div>
</div>