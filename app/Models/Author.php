<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Author extends Model
{
    protected $fillable = ['nombre', 'apellidos', 'email'];

    // Relación 1:1 — un autor tiene un perfil
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    // Relación 1:N — un autor tiene muchos libros
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
