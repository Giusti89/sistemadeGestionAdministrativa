<?php

namespace App\Policies;
use App\Models\Cliente;
use App\Models\Trabajo;
use App\Models\User;

class TrabajoPolicy
{
    public function trabajoID(User $user, Trabajo $trabajo)
    {
        return $user->id === $trabajo->cliente->usuario_id;
    }
}
