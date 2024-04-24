<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\User;

class ClientePolicy
{
    public function autor(User $user, Cliente $clientes)
    {
        if ($user->id == $clientes->usuario_id) {
            return true;
        } else {
            return false;
        }
    }
}
