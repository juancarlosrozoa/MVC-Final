<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'semestre',
        'nombre',
        'creditos',
        'docente',
        'prerrequisito',
        'htrabajoautonomo',
        'htrabajodirigido',
    ];
}