<?php

namespace App\Livewire;

use App\Models\Gasto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

use Livewire\Component;

class TablaGastos extends Component
{
    use WithPagination;

    public $paginate = 4;
    public $month;
    public $year;
    public $userId;
    public $search;
    public $mes;
    public $anio;

    public function mount()
    {
        $this->mes = Carbon::now()->month;
        $this->anio = Carbon::now()->year;
    }

    public function render()
    {
        $gastos = Gasto::where('usuario_id', Auth::id())
                        ->whereMonth('fecha', $this->mes)
                        ->whereYear('fecha', $this->anio)
                        ->paginate($this->paginate);

        return view('livewire.tabla-gastos', ['gastos' => $gastos]);
    }
    
}
