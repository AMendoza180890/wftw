<?php

namespace app\controlador;

class authC
{
    public static function startSession(): void
    {
        if (session_status() !== PHP_SESSION_NONE) {
            return;
        }

        if (!headers_sent()) {
            $secure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';

            session_set_cookie_params([
                'lifetime' => 0,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax',
                'secure' => $secure,
            ]);
        }

        session_start();
    }

    public static function isLoggedIn(): bool
    {
        self::startSession();

        return !empty($_SESSION['ingreso']);
    }

    public static function requireLogin(): void
    {
        if (!self::isLoggedIn()) {
            self::deny(401, 'Unauthorized');
        }
    }

    public static function requireRole(array $roleIds): void
    {
        self::requireLogin();

        $rolid = (int) ($_SESSION['rolid'] ?? 0);

        if (!in_array($rolid, $roleIds, true)) {
            self::deny(403, 'Forbidden');
        }
    }

    public static function csrfToken(): string
    {
        self::startSession();

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public static function csrfField(): string
    {
        return '<input type="hidden" name="csrf_token" value="' . e(self::csrfToken()) . '">';
    }

    public static function validateCsrf(?string $token = null): bool
    {
        self::startSession();

        $token = $token ?? ($_POST['csrf_token'] ?? '');

        if ($token === '' || empty($_SESSION['csrf_token'])) {
            return false;
        }

        return hash_equals($_SESSION['csrf_token'], $token);
    }

    public static function requireCsrf(): void
    {
        if (!self::validateCsrf()) {
            self::deny(403, 'Invalid CSRF token');
        }
    }

    private static function deny(int $code, string $message): void
    {
        http_response_code($code);

        if (self::wantsJson()) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['error' => $message]);
            exit;
        }

        exit($message);
    }

    private static function wantsJson(): bool
    {
        $accept = $_SERVER['HTTP_ACCEPT'] ?? '';

        return strpos($accept, 'application/json') !== false
            || !empty($_SERVER['HTTP_X_REQUESTED_WITH']);
    }
}
