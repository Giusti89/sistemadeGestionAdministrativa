<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pago extends Model
{
    protected $table = 'pago';
    use HasFactory;
    protected $fillable = [
        'fecha',
        'pago',
        'ordenpago_id',
    ];
    public function ordenPago()
    {
        return $this->belongsTo(ordenpago::class);
    }
}
