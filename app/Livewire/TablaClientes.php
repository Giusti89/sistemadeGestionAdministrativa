<?php

namespace App\Livewire;

use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

use Livewire\Component;

class TablaClientes extends Component
{
    use WithPagination;
    public $usuario;
    public $search;
    public $paginate=5;
    public function render()
    {
        
        $usuario = Auth::user(); 
        $clientes = Cliente::where('nombre', 'like', '%' . $this->search . '%')
        ->where ('usuario_id', $usuario->id)              
        ->paginate($this->paginate);
        
        return view('livewire.tabla-clientes', compact('clientes'));
    }
}
