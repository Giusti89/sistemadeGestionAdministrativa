<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    use HasFactory;
    protected $fillable = [
        'trabajo',
        'descripcion',
        'cantidad',
        'estado',
        'ganancia',
        'gananciaefectivo',
        'iva',
        'manobra',
        'ivaefectivo',
        'Costofactura',
        'Costoproduccion',
        'Costofinal',
        'cliente_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function Insumos()
    {
        return $this->hasMany(Insumo::class);
    }
    
    public function ordenpagos()
    {
        return $this->hasMany(Ordenpago::class);
    }
}
