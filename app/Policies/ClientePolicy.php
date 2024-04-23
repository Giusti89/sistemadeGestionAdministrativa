<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\User;

class ClientePolicy
{
    public function autor(User $user, Cliente $cliente)
    {
        if ($user->id == $cliente->usuario_id) {
            return true;
        } else {
            return false;
        }
    }
}
