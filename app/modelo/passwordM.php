<?php

namespace app\modelo;

class passwordM
{
    public static function hash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verify(string $password, string $stored): bool
    {
        if ($stored === '') {
            return false;
        }

        $info = password_get_info($stored);

        if ($info['algo'] !== null && $info['algo'] !== 0) {
            return password_verify($password, $stored);
        }

        return hash_equals($stored, $password);
    }

    public static function needsRehash(string $stored): bool
    {
        $info = password_get_info($stored);

        if ($info['algo'] === null || $info['algo'] === 0) {
            return true;
        }

        return password_needs_rehash($stored, PASSWORD_DEFAULT);
    }
}
