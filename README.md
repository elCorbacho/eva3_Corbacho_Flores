# EVA3
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

7. **Seeders**
 - Ejecuta los seeders para poblar la base de datos:
  ```bash
  php artisan db:seed
  ```


##  RUTA API
Accede a la aplicación en [http://localhost:8000/proyectos](http://localhost:8000/proyectos).

##  Endpoints principales


### **Endpoints de Autenticación API** (`routes/api.php`)
| Método    | Endpoint           | Descripción                                 |
|-----------|-------------------|---------------------------------------------|
| **POST**  | `/api/register`   | Registrar un nuevo usuario y obtener token  |
| **POST**  | `/api/login`      | Iniciar sesión y obtener token JWT          |


### **Endpoints API** (`routes/api.php`)
| Método    | Endpoint                      | Descripción                              |
|-----------|------------------------------|------------------------------------------|
| **GET**   | `/api/proyectosAPI`          | Listar todos los proyectos               |
| **GET**   | `/api/proyectosAPI/{id}`     | Obtener proyecto por ID                  |
| **POST**  | `/api/proyectosAPI`          | Crear un nuevo proyecto                  |
| **PATCH** | `/api/proyectosAPI/{id}`     | Actualizar proyecto por ID               |
| **DELETE**| `/api/proyectosAPI/{id}`     | Eliminar proyecto por ID                 |


##  Ejemplo de uso de seeders y factories
- Ejecuta un seeder de usuarios:
  ```bash
  php artisan db:seed --class=users
  ```
- Ejecuta un factory para proyectos:
  ```bash
  php artisan db:seed --class=proyectos_factory
  ```

##  Ejemplo de pruebas en postman
```bash
EVA3.postman_collection.json
```