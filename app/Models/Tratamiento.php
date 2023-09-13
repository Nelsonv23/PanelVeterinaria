<?php

namespace App\Models;

use App\Casts\PrecioCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tratamiento extends Model
{
    use HasFactory;
    protected $cast = [
        'price' => PrecioCast::class,
    ];
    public function pacientes(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

}
