# WFTW — Wheels for the World

Sistema de registro para el evento **Wheels for the World**: gestión de beneficiarios, usuarios administradores y reportes PDF.

---

## Funcionalidades

- **Beneficiarios**: registrar, editar, consultar, dar de baja/reactivar y marcar como *atendidos*.
  Al marcar un beneficiario como atendido se genera y descarga automáticamente su **reporte de entrega en PDF** (dompdf).
- **Catálogo de diagnósticos** unificado entre los formularios de registro y edición.
- **Usuarios y roles**: alta, edición (incluida la selección correcta del rol actual) y desactivación de usuarios administradores.
- **Dashboard** con conteos de usuarios y beneficiarios.
- **Subida de fotos** de beneficiarios y usuarios con validación de tipo MIME, límite de 2 MB, re-codificación vía GD y nombres de archivo únicos.

---

## Requisitos

- PHP >= 8.1 (extensiones: `pdo_mysql`, `mbstring`, `gd`, `dom`)
- Apache con `mod_rewrite`
- MySQL >= 5.7
- Composer 2.x

---

## Instalación

### 1. Clonar e instalar dependencias

```bash
git clone https://github.com/AMendoza180890/wftw.git
cd wftw
composer install
```

### 2. Configurar entorno

```bash
cp .env.example .env
```

Edita `.env`:

```env
DB_HOST=localhost
DB_NAME=wftw_db
DB_USER=root
DB_PASS=
APP_ENV=development
```

### 3. Crear base de datos

```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS wftw_db CHARACTER SET utf8mb4"
mysql -u root -p wftw_db < database/schema.sql
```

Credencial inicial de desarrollo: `admin` / `changeme` (se re-hashea automáticamente en el primer login).

### 4. Servidor web

Coloca el proyecto en `htdocs/wftw` (XAMPP) y accede a:

```
http://localhost/wftw
```

Asegúrate de que `mod_rewrite` esté habilitado. Las rutas usan `.htaccess`:

```
http://localhost/wftw/inicio
http://localhost/wftw/catbeneficiario
```

---

## Estructura del proyecto

```
wftw/
├── app/
│   ├── Ajax/              # Endpoints AJAX (requieren sesión)
│   ├── controlador/       # Lógica de negocio
│   ├── modelo/            # Acceso a datos
│   └── vista/             # Plantillas AdminLTE 2
├── database/schema.sql    # Esquema sanitizado
├── tests/                 # PHPUnit + smoke tests
├── .env.example
├── index.php
└── composer.json
```

---

## Pruebas

```bash
# Unit tests (PHPUnit)
composer test

# Smoke tests de regresión (Stages 0–4)
composer test:smoke
```

---

## Seguridad

- Credenciales en `.env` (nunca en git)
- Contraseñas con `password_hash()`
- CSRF en formularios y acciones POST
- Endpoints AJAX y PDF protegidos por sesión
- `.htaccess` bloquea acceso directo a `app/modelo/` y `app/bkdatabase/`

---

## Despliegue

```bash
composer install --no-dev --optimize-autoloader
```

Configura `.env` en el servidor con credenciales de producción y rota las contraseñas por defecto.

---

## Tecnologías

| Tecnología | Versión | Uso |
|---|---|---|
| PHP | 8.1+ | Backend |
| MySQL | 5.7+ | Base de datos |
| AdminLTE | 2.x | UI |
| Bootstrap | 3.x | Estilos |
| jQuery | 3.7 | Frontend |
| DataTables | 2.2 | Tablas |
| dompdf | ^3.1 | PDFs |
| Composer | 2.x | Dependencias |

---

## Autor

**Allan Mendoza** — [@AMendoza180890](https://github.com/AMendoza180890)

Licencia: MIT
