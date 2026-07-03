<?php

namespace app\controlador;

class tratamientoImagen
{
    public static function tratamientoTipoImagen($nombreElemento, $elemento)
    {
        return imagenUpload::guardar(
            (string) $nombreElemento,
            is_array($elemento) ? $elemento : [],
            'app/vista/img/usuario',
            'U'
        );
    }
}
