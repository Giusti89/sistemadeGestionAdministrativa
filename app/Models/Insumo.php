<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $fillable = [
        'nombre',
        'detalle',
        'costo',
        'trabajo_id',
    ];

    public function trabajo()
    {
        return $this->belongsTo(Trabajo::class);
    }
}
