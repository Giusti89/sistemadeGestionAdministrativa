<?php

namespace App\Livewire;

use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

use Livewire\Component;

class TablaClientes extends Component
{
    use WithPagination;
    public $usuario;
    public $search='';
    public $paginate;

    public function mount()
    {
        $this->paginate = 10;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPaginate()
    {
        $this->resetPage();
    }

    public function render()
    {

        $usuario = Auth::user();
        $diferenciaDias = Carbon::parse($usuario->inicio)->diffInDays($usuario->final);
        $clientes = Cliente::where('nombre', 'like', '%' . $this->search . '%')
            ->where('usuario_id', $usuario->id)
            ->paginate($this->paginate > 0 ? $this->paginate : 10);

        return view('livewire.tabla-clientes', compact('clientes', 'diferenciaDias'));
    }
}
