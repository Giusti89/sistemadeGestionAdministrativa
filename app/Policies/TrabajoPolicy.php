<?php

namespace App\Policies;
use App\Models\Cliente;
use App\Models\Trabajo;
use App\Models\User;

class TrabajoPolicy
{
    public function trabajoID(User $user, Trabajo $trabajo)
    {
        $cliente = Cliente::find($trabajo->cliente_id);
        if ($cliente && $user->id === $cliente->usuario_id) {
            return true;
        }
        return false;
    }
}
