<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estadotrabajo extends Model
{
    use HasFactory;
     protected $fillable = [
        'nombre',
    ];

    public function trabajo()
    {
        return $this->belongsTo(Trabajo::class);
    }
}
