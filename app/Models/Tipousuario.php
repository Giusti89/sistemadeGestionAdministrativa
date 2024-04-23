<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipousuario extends Model
{
    protected $table = 'tipousuario';
    protected $fillable = [
        'nombre',
    ];
}
