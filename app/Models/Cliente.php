<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido',
        'contacto',
        'nit',
        'email',
        'usuario_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function trabajos()
    {
        return $this->hasMany(Trabajo::class, 'cliente_id');
    }
    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }
}
