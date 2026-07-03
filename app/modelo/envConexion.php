<?php
namespace app\modelo;

class envConexion
{
    public $datos;

    public function __construct()
    {
        if (is_readable(__DIR__ . '/envConexion.local.php')) {
            require __DIR__ . '/envConexion.local.php';
            if (isset($localDbConfig) && is_array($localDbConfig)) {
                $this->datos = $localDbConfig;
                return;
            }
        }

        $this->datos = [
            'DATABASENAME' => $this->env('DB_NAME'),
            'SERVIDOR' => $this->env('DB_HOST', 'localhost'),
            'USER' => $this->env('DB_USER'),
            'PASSW' => $this->env('DB_PASS', ''),
        ];
    }

    private function env(string $key, string $default = ''): string
    {
        $value = $_ENV[$key] ?? getenv($key);

        if ($value === false || $value === null || $value === '') {
            return $default;
        }

        return (string) $value;
    }
}
