<?php

namespace App\Livewire;

use App\Models\Trabajo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TablaTrabajos extends Component
{
    use WithPagination;
    public $user;
    public $paginate = 5;
    public $search;

    public function render()
    {
        $user = Auth::user();
        $trab = Trabajo::whereIn('cliente_id', function ($query) use ($user) {
            $query->select('id')
                ->from('clientes')
                ->where('usuario_id', $user->id);
        })
            ->whereHas('cliente', function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            })
            ->with('cliente')
            ->paginate($this->paginate);

        return view('livewire.tabla-trabajos', compact('trab'));
    }
}
