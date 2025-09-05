# 15-eval1-api-migrate-db-test-README BRANCH merged
##  Instalación y configuración
1. **Instala las dependencias PHP:**
  ```bash
  composer install
  ```
2. **Copia el archivo de entorno y configura tus variables:**
  ```bash
  cp .env.example .env
  ```
3. **Genera la clave de la aplicación y de JWT:**
  ```bash
  php artisan key:generate

  php artisan jwt:secret
  ```
4. **Configura la base de datos en el archivo `.env`.**
5. **Ejecuta las migraciones:**
  ```bash
  php artisan migrate
  ```
6. **Inicia el servidor:**
  ```bash
  php artisan serve
  ```
## Seeders 
 - Ejecuta los seeders para poblar la base de datos:
  ```bash
  php artisan db:seed
  ```


##  Uso Web
Accede a la aplicación en [http://localhost:8000/proyectos](http://localhost:8000/proyectos).

##  Endpoints principales

### **Endpoints API** (`routes/api.php`)
|  Método  |  Endpoint                   |  Descripción                        |
|------------|------------------------------|---------------------------------------|
| **POST**   | `/api/login`                 | Iniciar sesión y obtener token JWT    |
| **POST**   | `/api/register`              | Registrar un nuevo usuario            |
| **GET**    | `/api/proyectosAPI`          | Listar todos los proyectos            |
| **GET**    | `/api/proyectosAPI/{id}`     | Obtener proyecto por ID               |
| **POST**   | `/api/proyectosAPI`          | Crear un nuevo proyecto               |
| **PATCH**  | `/api/proyectosAPI/{id}`     | Actualizar proyecto por ID            |
| **DELETE** | `/api/proyectosAPI/{id}`     | Eliminar proyecto por ID              |
| **GET**    | `/api/user`                  | Obtener usuario autenticado (JWT)     |
> **Nota:** Todos los endpoints API están activos en `routes/api.php` y utilizan el prefijo `/api`.




##  Autenticación JWT y uso en Postman
1. **Registro de usuario:**
  - Método: POST
  - URL: `http://localhost:8000/api/register`
  - Body (JSON):
  ```json
  {
  "name": "Andrés Corbacho",
  "email": "corbacho@gmail.com",
  "password": "password123"
  }
  ```
  - Recibirás un token JWT en la respuesta.

2. **Login:**
  - Método: POST
  - URL: `http://localhost:8000/api/login`
  - Body (JSON):
  ```json
  {
  "email": "corbacho@gmail.com",
  "password": "password123"
  }
  ```
  - Recibirás un token JWT en la respuesta.

3. **Usar el token en endpoints protegidos:**
  - Agrega el header:
  ```
  Authorization: Bearer TU_TOKEN_JWT
  ```
  - Ejemplo para obtener proyectos:
  - Método: GET
  - URL: `http://localhost:8000/api/proyectosAPI`
  - Header: `Authorization: Bearer TU_TOKEN_JWT`
4. **Eliminar un proyecto:**
  - Método: DELETE
  - URL: `http://localhost:8000/api/proyectosAPI/4`
  - Header: `Authorization: Bearer TU_TOKEN_JWT`
  - Respuesta:
  ```json
  {
  "message": "Proyecto eliminado correctamente"
  }
  ```

##  Ejemplo de uso de seeders y factories
- Ejecuta un seeder de usuarios:
  ```bash
  php artisan db:seed --class=users
  ```
- Ejecuta un factory para proyectos:
  ```bash
  php artisan db:seed --class=proyectos_factory
  ```

##  Estructura principal
- `app/Models/Proyecto.php` — Modelo Eloquent para proyectos
- `app/Models/User.php` — Modelo Eloquent para usuarios
- `database/migrations/` — Migraciones de base de datos
- `database/seeders/` — Seeders para poblar datos
- `database/factories/` — Factories para datos de prueba
- `routes/web.php` — Rutas web (vistas y formularios)
- `routes/api.php` — Rutas API (JSON y JWT)
---
