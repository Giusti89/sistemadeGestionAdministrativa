<?php

namespace App\Policies;

use App\Models\ordenpago;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrdenpagoPolicy
{
    use HandlesAuthorization;

    public function ordenpago(User $user, ordenpago $oredenpago)
    {        
        return $user->id === $oredenpago->trabajo->cliente->usuario_id;
    }
}
