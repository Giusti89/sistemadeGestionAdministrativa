<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'telefono',
        'password',
        'tipousuario_id',
        'inicio',
        'logo',
        'final',
        'suscripcion'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function tipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class, 'tipousuario_id');
    }
    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'usuario_id');
    }
    
    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }
}
