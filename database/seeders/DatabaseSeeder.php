<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $gabriel = Author::create([
            'nombre'    => 'Gabriel',
            'apellidos' => 'García Márquez',
            'email'     => 'gabo@ejemplo.com',
        ]);

        $isabel = Author::create([
            'nombre'    => 'Isabel',
            'apellidos' => 'Allende',
            'email'     => 'isabel@ejemplo.com',
        ]);

        $jrr = Author::create([
            'nombre'    => 'J.R.R.',
            'apellidos' => 'Tolkien',
            'email'     => 'tolkien@ejemplo.com',
        ]);

        // Perfiles — relación 1:1
        Profile::create([
            'author_id'        => $gabriel->id,
            'biografia'        => 'Escritor colombiano, Premio Nobel de Literatura 1982.',
            'fecha_nacimiento' => '1927-03-06',
            'nacionalidad'     => 'Colombiana',
        ]);

        Profile::create([
            'author_id'        => $isabel->id,
            'biografia'        => 'Escritora chilena, una de las autoras más leídas en español.',
            'fecha_nacimiento' => '1942-08-02',
            'nacionalidad'     => 'Chilena',
        ]);

        Profile::create([
            'author_id'        => $jrr->id,
            'biografia'        => 'Escritor, poeta y filólogo británico, padre de la fantasía moderna.',
            'fecha_nacimiento' => '1892-01-03',
            'nacionalidad'     => 'Británica',
        ]);

        // Libros — relación 1:N
        Book::create([
            'author_id'        => $gabriel->id,
            'titulo'           => 'Cien años de soledad',
            'isbn'             => '978-0-06-088328-7',
            'precio'           => 15.99,
            'anio_publicacion' => 1967,
        ]);

        Book::create([
            'author_id'        => $gabriel->id,
            'titulo'           => 'El amor en los tiempos del cólera',
            'isbn'             => '978-0-14-303943-3',
            'precio'           => 13.50,
            'anio_publicacion' => 1985,
        ]);

        Book::create([
            'author_id'        => $isabel->id,
            'titulo'           => 'La casa de los espíritus',
            'isbn'             => '978-0-14-243718-7',
            'precio'           => 12.99,
            'anio_publicacion' => 1982,
        ]);

        Book::create([
            'author_id'        => $jrr->id,
            'titulo'           => 'El señor de los anillos',
            'isbn'             => '978-0-618-57494-1',
            'precio'           => 29.99,
            'anio_publicacion' => 1954,
        ]);

        Book::create([
            'author_id'        => $jrr->id,
            'titulo'           => 'El hobbit',
            'isbn'             => '978-0-618-00221-3',
            'precio'           => 11.99,
            'anio_publicacion' => 1937,
        ]);
    }
}
