<?php

namespace App\Livewire;

use App\Models\Insumo;
use Livewire\Component;
use App\Models\Trabajo;
use Livewire\WithPagination;

class TablaInsumos extends Component
{
    use WithPagination;
    public $identificador;
    public $paginate = 5;
    


    public function mount($identificador)
    {
        $this->identificador = $identificador;
    }

    public function render()
    {
        
        $trabajo = Trabajo::where('id', $this->identificador)->value('trabajo');
        $trabajoid = Trabajo::where('id', $this->identificador)->value('id');
        $manobra = Trabajo::where('id', $this->identificador)->value('manobra');

        $insumos = Insumo::where('trabajo_id', $this->identificador)->paginate($this->paginate);

        $total = Insumo::where('trabajo_id', $this->identificador)->sum('costo');
    
        foreach ($insumos as $cotizacion) {
            
            $this->authorize('view', $cotizacion);
        }
    
        return view('livewire.tabla-insumos', compact('insumos','total','trabajo','trabajoid','manobra'));
    }
}
