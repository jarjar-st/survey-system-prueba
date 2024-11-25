# Survey System API

Este proyecto es una API RESTful desarrollada en Laravel para la gestión de un sistema de encuestas. Permite realizar operaciones CRUD sobre usuarios, preguntas, respuestas y votos, además de generar reportes en Excel.

## Requisitos previos

Antes de comenzar, tener instalados los siguientes programas en tu máquina:

- PHP ≥ 8.2
- Composer ≥ 2.0
- MySQL ≥ 5.7 o compatible
- Laravel ≥ 11
- Opcional: Postman o cualquier herramienta para probar APIs

## Instalación

Seguir estos pasos para configurar y ejecutar el proyecto localmente:

1. **Clonar el repositorio**
    ```bash
    git clone https://github.com/jarjar-st/survey-system-prueba.git
    cd survey-system
    ```

2. **Instalar dependencias**
    ```bash
    composer install
    ```

3. **Configurar el archivo .env**
    Renombra el archivo `.env.example` a `.env`:
    ```bash
    cd .env.example .env
    ```
    Luego editar el archivo `.env` para configurar la conexión a la base de datos:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=survey_db
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```

4. **Generar la clave de la aplicación**
    ```bash
    php artisan key:generate
    ```

5. **Ejecutar las migraciones**
    ```bash
    php artisan migrate
    ```
    Esto creará las tablas necesarias en tu base de datos.

6. **Iniciar el servidor de desarrollo**
    ```bash
    php artisan serve
    ```
    La API estará disponible en [http://localhost:8000](http://localhost:8000).

## Uso de la API

### Endpoints principales

| Método | Ruta                     | Descripción                           |
|--------|--------------------------|---------------------------------------|
| GET    | /api/users               | Listar todos los usuarios             |
| POST   | /api/users               | Crear un nuevo usuario                |
| PUT    | /api/users/{id}          | Actualizar un usuario existente       |
| DELETE | /api/users/{id}          | Eliminar un usuario                   |
| GET    | /api/asks                | Listar todas las preguntas            |
| POST   | /api/asks                | Crear una nueva pregunta              |
| PUT    | /api/asks/{id}           | Actualizar una pregunta existente     |
| DELETE | /api/asks/{id}           | Eliminar una pregunta                 |
| GET    | /api/answers             | Listar todas las respuestas           |
| POST   | /api/answers             | Crear una nueva respuesta             |
| PUT    | /api/answers/{id}        | Actualizar una respuesta existente    |
| DELETE | /api/answers/{id}        | Eliminar una respuesta                |
| POST   | /api/votings             | Emitir un voto                        |
| GET    | /api/answers/{id}/votes  | Obtener la cantidad de votos de una respuesta |
| GET    | /api/asks/{id}/report    | Generar un reporte en Excel de una pregunta |

### Ejemplo de peticiones

1. **Crear un usuario**
    - Método: POST
    - URL: `http://localhost:8000/api/users`
    - Body:
    ```json
    {
      "name": "Josue Meza",
      "id_number": "123456789"
    }
    ```

2. **Crear una pregunta**
    - Método: POST
    - URL: `http://localhost:8000/api/asks`
    - Body:
    ```json
    {
      "description": "¿Cuál es tu color favorito?"
    }
    ```

3. **Emitir un voto**
    - Método: POST
    - URL: `http://localhost:8000/api/votings`
    - Body:
    ```json
    {
      "answer_id": 1,
      "user_id": 1
    }
    ```

4. **Generar reporte en Excel**
    - Método: GET
    - URL: `http://localhost:8000/api/asks/1/report`
    Esto descargará un archivo `ask_report.xlsx` con las respuestas y votos asociados a la pregunta especificada, se recomienda probarlo
    en el navegador.

## Estructura del proyecto

El proyecto sigue la estructura estándar de Laravel. Los elementos clave son:

- **Controladores**: Lógica de negocio en `app/Http/Controllers/`.
- **Modelos**: Definiciones de tablas y relaciones en `app/Models/`.
- **Migraciones**: Esquema de base de datos en `database/migrations/`.
- **Rutas**: Definidas en `routes/api.php`.

## Tecnologías utilizadas

- **Framework**: Laravel
- **Base de datos**: MySQL
- **Librerías**:
  - Laravel Excel para la generación de reportes en Excel.

## Pruebas

Para probar los endpoints, se puede usar herramientas como:

- **Postman**: Importa manualmente los endpoints y probar con los datos proporcionados.
- **curl**: Ejecutar los comandos desde la terminal para probar las rutas.

Ejemplo con `curl`:
```bash
curl -X POST http://localhost:8000/api/users \
-H "Content-Type: application/json" \
-d '{"name":"John Doe","id_number":"123456789"}'
```

## Contribuciones

Este proyecto es solo para fines de evaluación. Si se tiene alguna sugerencia o se encuentra un problema, por favor, crear un issue en este repositorio.

## Licencia

Este proyecto no tiene licencia específica y está destinado únicamente para la prueba técnica.