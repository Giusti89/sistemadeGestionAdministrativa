<?php

namespace App\Livewire;

use App\Models\ordenpago;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class TablaPagados extends Component
{
    use WithPagination;
    public $user;
    public $paginate;
    public $search;

    public function mount()
    {
        $this->paginate = 5;
    }

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
            ->where('estadopago_id', 1);

        if ($this->search) {
            $query->whereHas('trabajo.cliente', function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            });
        }

        $data = $query->paginate($this->paginate  > 0 ? $this->paginate : 10);

        return view('livewire.tabla-pagados', compact('data'));
    }
}
