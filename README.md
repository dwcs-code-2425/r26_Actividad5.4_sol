# 🔹 1. Crear proyecto con Composer (mínimo)

composer create-project symfony/skeleton:"7.4.*" api_libros
cd api_libros

# 🔹 2. Instalar las dependencias mínimas necesarias

composer require orm
composer require maker --dev
composer require symfony/serializer-pack
composer require --dev phpunit/phpunit

# 🔹 Qué se instala realmente

- `orm` → Doctrine (base de datos)  
- `maker` → comandos tipo `make:entity`, `make:controller`  
- `serializer-pack` → necesario para devolver JSON correctamente
- `PHPUnit`→ necesario para pruebas

# Configurar base de datos

DATABASE_URL="mysql://root:abc123.@127.0.0.1:3306/api_librosp?serverVersion=8.0.40&charset=utf8mb4"

# Crear la base de datos

php bin/console doctrine:database:create

# Crear la entidad Libro

php bin/console make:entity Libro

Atributos:  
- `titulo` (string) no null

# Crear y ejecutar migraciones

php bin/console make:migration
php bin/console doctrine:migrations:migrate

# Crear controlador

php bin/console make:controller ApiLibroController

Si usamos tests, nos dará un error y será necesario:

composer require --dev phpunit/phpunit

# Insertar datos de prueba

use api_libros;

INSERT INTO libro (titulo) VALUES 
('El Quijote'),
('Cien años de soledad'),
('1984'),
('La sombra del viento'),
('El nombre del viento');



# Añadir anotación mediante atributo PHP a nivel de clase en el ApiLibroController:  

#[Route('/api', name: 'app_api_')]

# Añadir método en el controlador
A nivel de método:

#[Route('/libros', name: 'libros', methods: ['GET'])]
public function index(LibroRepository $repo): JsonResponse
{
    return $this->json($repo->findAll());
}

# Arrancar el servidor

symfony server:start

# Probar el método con un navegador o con Postman

Añadir `http://localhost:8000/api/libros` con GET

# Añadir `/libros` con otros métodos POST, PUT y PATCH y validación simple

Si se quiere validación de Symfony:

composer require symfony/validator