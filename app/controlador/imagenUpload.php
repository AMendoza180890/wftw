<?php

namespace app\controlador;

use Exception;

class imagenUpload
{
    private const MAX_BYTES = 2097152;

    public static function guardar(string $tmpPath, array $file, string $directory, string $prefix): string
    {
        if ($tmpPath === '' || !is_uploaded_file($tmpPath)) {
            return '';
        }

        if (($file['size'] ?? 0) > self::MAX_BYTES) {
            return '';
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($tmpPath);

        if ($mime === 'image/jpeg') {
            $image = @imagecreatefromjpeg($tmpPath);
            if ($image === false) {
                return '';
            }

            $name = $prefix . mt_rand(10, 999) . '.jpg';
            $path = rtrim($directory, '/\\') . '/' . $name;
            imagejpeg($image, $path);
            imagedestroy($image);

            return str_replace('\\', '/', $path);
        }

        if ($mime === 'image/png') {
            $image = @imagecreatefrompng($tmpPath);
            if ($image === false) {
                return '';
            }

            $name = $prefix . mt_rand(10, 999) . '.png';
            $path = rtrim($directory, '/\\') . '/' . $name;
            imagepng($image, $path);
            imagedestroy($image);

            return str_replace('\\', '/', $path);
        }

        return '';
    }
}
