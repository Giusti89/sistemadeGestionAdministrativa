<?php

namespace App\Livewire;

use App\Models\ordenpago;
use App\Models\Trabajo;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class TablaPagos extends Component
{
    use WithPagination;
    public $user;
    public $paginate = 4;
    public $search;

    public function render()
    {
        $user = Auth::user();
    
        $query = ordenpago::with(['trabajo.cliente'])
            ->whereHas('trabajo.cliente', function ($query) use ($user) {
                $query->where('usuario_id', $user->id);
            })
            ->whereHas('trabajo', function ($query) {
                $query->where('estado', 1);
            })
            ->where('estadopago_id', 2);
    
        if ($this->search) {
            $query->whereHas('trabajo.cliente', function ($query) {
                $query->where('nombre', 'like', '%'.$this->search.'%');
            });
        }
    
        $data = $query->paginate($this->paginate);
    
        return view('livewire.tabla-pagos', compact('data'));
    }
}
