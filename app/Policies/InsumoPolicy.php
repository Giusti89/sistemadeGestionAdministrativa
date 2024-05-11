<?php

namespace App\Policies;

use App\Models\Insumo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InsumoPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Insumo $insumo)
    {        
        return $user->id === $insumo->trabajo->cliente->usuario_id;
    }
}
