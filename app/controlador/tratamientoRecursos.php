<?php

namespace app\controlador;

class tratamientoRecursos
{
    public static function tratamientoTipoImagenBeneficiario($nombreElemento, $elemento)
    {
        return imagenUpload::guardar(
            (string) $nombreElemento,
            is_array($elemento) ? $elemento : [],
            'app/vista/img/beneficiario',
            'b'
        );
    }
}
