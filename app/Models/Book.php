<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = ['author_id', 'titulo', 'isbn', 'precio', 'anio_publicacion'];

    // Relación 1:N inversa — un libro pertenece a un autor
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
