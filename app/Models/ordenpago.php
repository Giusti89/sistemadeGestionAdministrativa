<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordenpago extends Model
{
    use HasFactory;
    protected $fillable = [
        'total',
        'saldo',
        'cuenta',
        'trabajo_id',
        'estadopago_id',
    ];
    public function trabajo()
    {
        return $this->belongsTo(Trabajo::class);
    }
    public function pago()
    {
        return $this->hasMany(Pago::class, 'ordenpago_id');
    }
}
