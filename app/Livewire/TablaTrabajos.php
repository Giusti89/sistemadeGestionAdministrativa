<?php

namespace App\Livewire;

use App\Models\Trabajo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TablaTrabajos extends Component
{
    use WithPagination;

    public $searchMonth;
    public $paginate;
    public $user;
    public $search;

    public function mount()
    {
        $this->paginate = 10;
        $this->searchMonth = Carbon::now()->format('Y-m');
    }

    public function updatingSearchMonth()
    {
        $this->resetPage();
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
        $user = Auth::user();
        $monthYear = explode('-', $this->searchMonth);
        $month = $monthYear[1] ?? Carbon::now()->month;
        $year = $monthYear[0] ?? Carbon::now()->year;

        $trab = Trabajo::whereIn('cliente_id', function ($query) use ($user) {
            $query->select('id')
                ->from('clientes')
                ->where('usuario_id', $user->id);
        })
            ->whereHas('cliente', function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            })            
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->with('cliente')
            ->orderBy('estado', 'asc')
            ->paginate($this->paginate > 0 ? $this->paginate : 10);

            
        return view('livewire.tabla-trabajos', compact('trab'));
    }
}
