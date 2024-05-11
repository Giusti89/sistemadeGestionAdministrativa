<?php

namespace App\Policies;

use App\Models\pago;
use App\Models\User;

class PagoPolicy
{

    public function pagos(User $user, Pago $pago)
    {
        return $user->id === $pago->ordenPago->trabajo->cliente->user_id;
    }
}
