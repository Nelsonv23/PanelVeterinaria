<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Propietario extends Model
{
    use HasFactory;
    public function pacientes(): HasMany
    {
        return $this->hasMany(Paciente::class);
    }
}
