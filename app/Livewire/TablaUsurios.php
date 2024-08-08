<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class TablaUsurios extends Component
{
    use WithPagination;
    public $search;
    public $paginate = 5;

    public function render()
    {

        $users = User::withCount('clientes')
        ->where('name', 'like', '%' . $this->search . '%')
        ->where('tipousuario_id', 2)
        ->paginate($this->paginate);

        foreach ($users as $usuario) {
           
            $dif = Carbon::now()->diffInDays($usuario->final, false); 
            $fechaExpiracion = Carbon::parse($usuario->final);
                        
            if ($dif <= 0) {
                $usuario->mensaje = 'Suscripción expirada el ' . $fechaExpiracion->format('d/m/Y');
            } else {
                $usuario->mensaje = 'Expira en ' . $dif . ' días (el ' . $fechaExpiracion->format('d/m/Y') . ')';
            }
        }
        return view('livewire.tabla-usurios',compact('users'));
    }
}
