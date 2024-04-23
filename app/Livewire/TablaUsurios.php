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
        
        $users = User::where('name', 'like', '%' . $this->search . '%')
        ->where('tipousuario_id', 2)
        ->paginate($this->paginate);

        foreach ($users as $usuario) {
            $diferenciaDias = Carbon::parse($usuario->inicio)->diffInDays($usuario->final);
            $usuario->diferenciaDias = $diferenciaDias;
        }
        return view('livewire.tabla-usurios',compact('users'));
    }
}
