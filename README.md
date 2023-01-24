[English]

## Project Task List

This project is a to-do list web application developed with Laravel Jetstream.

# Characteristics

-   Create, edit and delete tasks.
-   Assign categories and priorities to tasks.
-   Filter tasks by status.
-   Add comments to tasks.
-   View tasks with pagination (10).
-   Authentication and authorization with Laravel Jetstream.
-   Design and styles with Tailwind and pure css.

# Requirements

-   XAMPP
-   PHP 8.2.0 or higher
-   MySQL
-   Composer

# Installation Instructions

-   Clone the repository.
-   Run composer i and npm i to install the dependencies.
-   Copy .env.example to .env and configure the connection to the database.
-   Run "php artisan key:generate" to generate a new application key.
-   Create a db in xampp with the name you want, I used 'tasklist', this name must be added to the .env in "DB_DATABASE=".
-   Run php artisan migrate to create the necessary tables.
    -   If you get errors when executing 'php artisan migrate', execute 'php artisan migrate --path=database/migrations/namemigration.php', execute one by one, I recommend starting with the 'users' table, then the table 'tasks', and then the others.
-   Run npm run build.
-   Run php artisan serve to start the development server.
-   Access http://127.0.0.1:8000 or http://localhost:8000 to see the application, as 'php artisan serve' tells you.
-   You create an account.

# Created by, <a href="https://twitter.com/Jozefzin" target="_blank">José Ignacio</a>.

[Spanish]

## Project Task List

Este proyecto es una aplicación web de lista de tareas desarrollada con Laravel Jetstream.

# Características

-   Crear, editar y eliminar tareas.
-   Asignar categorías y prioridades a las tareas.
-   Filtrar tareas por estado.
-   Agregar comentarios a las tareas.
-   Ver tareas con paginación (10).
-   Autenticación y autorización con Laravel Jetstream.
-   Diseño y estilos con Tailwind y css puro.

# Requisitos

-   XAMPP
-   PHP 8.2.0 o superior
-   MySQL
-   Composer

# Instrucciones de instalación

-   Clona el repositorio.
-   Ejecuta composer i y npm i para instalar las dependencias.
-   Copia .env.example a .env y configura la conexión a la base de datos.
-   Ejecute "php artisan key:generate" para generar una nueva clave de aplicación.
-   Cree una base de datos en xampp con el nombre que desee, yo use 'tasklist', este nombre debe agregarse al .env en "DB_DATABASE=".
-   Ejecuta php artisan migrate para crear las tablas necesarias.
    -   Si obtienes errores al momento de ejecutar 'php artisan migrate', ejecuta 'php artisan migrate --path=database/migrations/namemigration.php', ejecuta una por una, te recomiendo iniciar por la tabla 'users', despues la tabla 'tasks', y luego las otras.
-   Ejecuta npm run build.
-   Ejecuta php artisan serve para iniciar el servidor de desarrollo.
-   Accede a http://127.0.0.1:8000 o http://localhost:8000 para ver la aplicación, segun 'php artisan serve' te diga.
-   Creas una cuenta.

# Creado por, <a href="https://twitter.com/Jozefzin" target="_blank">José Ignacio</a>.
