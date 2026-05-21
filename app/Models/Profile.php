<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = ['author_id', 'biografia', 'fecha_nacimiento', 'nacionalidad'];

    // Relación 1:1 inversa — un perfil pertenece a un autor
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
