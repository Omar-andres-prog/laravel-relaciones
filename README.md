# Practica 2 - Laravel Relaciones

Practica de Laravel sobre relaciones entre modelos con Eloquent para la asignatura de Desarrollo Web en Entorno Servidor.

## Descripcion

He creado un proyecto Laravel nuevo que simula una biblioteca. Tiene 3 modelos (Author, Profile y Book) relacionados entre si mediante relaciones 1:1 y 1:N usando el ORM Eloquent.

## Modelos

**Author** - guarda los datos del autor
- nombre
- apellidos
- email

**Profile** - perfil del autor, relacion 1:1 con Author
- author_id (clave foranea)
- biografia
- fecha_nacimiento
- nacionalidad

**Book** - libros del autor, relacion 1:N con Author
- author_id (clave foranea)
- titulo
- isbn
- precio
- anio_publicacion

## Relaciones

### 1:1 — Author y Profile

Un autor tiene un perfil y un perfil pertenece a un autor.

```php
// En Author.php
public function profile(): HasOne
{
    return $this->hasOne(Profile::class);
}

// En Profile.php (relacion inversa)
public function author(): BelongsTo
{
    return $this->belongsTo(Author::class);
}
```

### 1:N — Author y Book

Un autor puede tener muchos libros pero cada libro solo tiene un autor.

```php
// En Author.php
public function books(): HasMany
{
    return $this->hasMany(Book::class);
}

// En Book.php (relacion inversa)
public function author(): BelongsTo
{
    return $this->belongsTo(Author::class);
}
```

## Rutas

| Metodo | URL | Descripcion |
|--------|-----|-------------|
| GET | /authors | todos los autores |
| GET | /authors/{id} | un autor |
| POST | /authors | crear autor |
| PUT | /authors/{id} | editar autor |
| DELETE | /authors/{id} | borrar autor |
| GET | /authors/{id}/profile | perfil del autor (1:1) |
| GET | /authors/{id}/books | libros del autor (1:N) |
| GET | /profiles/{id}/author | autor del perfil (inversa 1:1) |
| GET | /books/{id}/author | autor del libro (inversa 1:N) |

## Como ejecutarlo

```bash
git clone https://github.com/Omar-andres-prog/laravel-relaciones.git
cd laravel-relaciones

composer install

cp .env.example .env
php artisan key:generate
```

Configurar la base de datos en el .env y luego:

```bash
php artisan migrate
php artisan db:seed
php artisan serve
```

## Tecnologias usadas

- Laravel 12
- PHP 8.2
- MySQL
- Eloquent ORM
