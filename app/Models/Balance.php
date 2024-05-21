<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingreso',
        'egreso',
        'fecha',
        'trabajo_id',
        'gasto_id',
    ];

    public function trabajo()
    {
        return $this->belongsTo(Trabajo::class, 'trabajo_id');
    }

    public function gasto()
    {
        return $this->belongsTo(Gasto::class, 'gasto_id');
    }
}
