<?php

namespace App\Livewire;

use App\Models\Insumo;
use Livewire\Component;
use App\Models\Trabajo;

class TablaInsumos extends Component
{
    public $identificador;


    public function mount($identificador)
    {
        $this->identificador = $identificador;
    }

    public function render()
    {
        
        $trabajo = Trabajo::where('id', $this->identificador)->value('trabajo');

        $insumos = Insumo::where('trabajo_id', $this->identificador)->get();

        $total = Insumo::where('trabajo_id', $this->identificador)->sum('costo');
    
        foreach ($insumos as $cotizacion) {
            
            $this->authorize('view', $cotizacion);
        }
    
        return view('livewire.tabla-insumos', compact('insumos','total','trabajo'));
    }
}
