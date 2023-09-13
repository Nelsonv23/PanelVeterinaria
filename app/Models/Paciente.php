<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
    use HasFactory;
    public function propietario(): BelongsTo 
    {
        return $this->belongsTo(Propietario::class);
    }

    public function tratamientos(): HasMany 
    {
        return $this->hasMany(Tratamiento::class);
    }
}
