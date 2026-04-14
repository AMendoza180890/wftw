# WFTW — Wheels for the World

Sistema de registro para el evento **Wheels for the World**, desarrollado para gestionar el registro de participantes, generar reportes en PDF y administrar la información del evento.

---

## 📋 Tabla de Contenidos

- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Despliegue](#despliegue)
- [Tecnologías](#tecnologías)
- [Autor](#autor)

---

## ✅ Requisitos

- PHP >= 7.4
- Apache con `mod_rewrite` habilitado
- MySQL >= 5.7
- Composer
- Servidor web (Apache/Nginx) o XAMPP/WAMP para desarrollo local

---

## 🚀 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/AMendoza180890/wftw.git
cd wftw
```

### 2. Instalar dependencias PHP

```bash
composer install
```

### 3. Configurar la base de datos

Importa el esquema SQL en tu servidor MySQL:

```bash
mysql -u tu_usuario -p tu_base_de_datos < database/schema.sql
```

### 4. Configurar variables de entorno

Copia el archivo de ejemplo y edítalo con tus credenciales:

```bash
cp .env.example .env
```

Edita `.env` con tus datos:

```env
DB_HOST=localhost
DB_NAME=wftw_db
DB_USER=tu_usuario
DB_PASS=tu_contraseña
APP_ENV=development
```

### 5. Configurar el servidor web

Asegúrate de que `mod_rewrite` esté habilitado en Apache. El archivo `.htaccess` incluido redirige todas las rutas a `index.php`.

Para XAMPP/WAMP, coloca el proyecto dentro de `htdocs/` o `www/` y accede desde:

```
http://localhost/wftw
```

---

## ⚙️ Configuración

### Estructura de Autoload (PSR-4)

El proyecto usa Composer con PSR-4. Los namespaces están configurados en `composer.json`:

| Namespace | Directorio |
|---|---|
| `app\controlador` | `app/controlador/` |
| `app\modelo` | `app/modelo/` |
| `app\vista` | `app/vista/` |

### Rutas

El sistema de rutas usa el parámetro `ruta` vía `.htaccess`:

```
http://localhost/wftw/home      → index.php?ruta=home
http://localhost/wftw/registro  → index.php?ruta=registro
```

---

## 📁 Estructura del Proyecto

```
wftw/
├── app/
│   ├── controlador/    # Controladores MVC
│   ├── modelo/         # Modelos de base de datos
│   └── vista/          # Vistas (HTML/PHP)
├── vendor/             # Dependencias (generado por Composer)
├── .htaccess           # Configuración de rutas Apache
├── composer.json       # Dependencias del proyecto
├── index.php           # Punto de entrada principal
└── README.md
```

---

## 🌐 Despliegue en Producción

### En servidor compartido (cPanel / hosting)

1. Sube todos los archivos al servidor via FTP o Git.
2. Ejecuta `composer install --no-dev --optimize-autoloader` en el servidor.
3. Asegúrate de que `mod_rewrite` esté habilitado.
4. Configura las credenciales de base de datos directamente en el archivo de configuración o mediante variables de entorno del servidor.
5. Ajusta los permisos de carpetas si es necesario:

```bash
chmod -R 755 app/
chmod -R 644 .htaccess
```

### En servidor VPS/Linux (Apache)

1. Clona el repositorio en `/var/www/html/wftw`.
2. Instala dependencias: `composer install --no-dev`.
3. Habilita `mod_rewrite`:

```bash
a2enmod rewrite
systemctl restart apache2
```

4. Configura el VirtualHost para apuntar al directorio del proyecto.

---

## 🛠 Tecnologías

| Tecnología | Versión | Uso |
|---|---|---|
| PHP | 7.4+ | Backend |
| MySQL | 5.7+ | Base de datos |
| Bootstrap | 4.x | UI / Estilos |
| jQuery | 3.x | Interactividad frontend |
| dompdf | ^1.2 | Generación de PDFs |
| Composer | 2.x | Gestión de dependencias |

---

## 👤 Autor

**Allan Mendoza**
- GitHub: [@AMendoza180890](https://github.com/AMendoza180890)
- Email: allanmaleman@gmail.com

---

## 📄 Licencia

Este proyecto está bajo la licencia MIT.
