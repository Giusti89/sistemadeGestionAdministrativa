<?php

namespace App\Livewire;

use App\Models\Gasto;
use App\Models\Trabajo;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class TablaDatos extends Component
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
        $userId = auth()->user()->id;

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        
        $user = User::withCount('clientes')->find($userId);
        $clientCount = $user->clientes_count;


        $newClientsCount = User::find($userId)->clientes()
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        $jobCount = Trabajo::whereHas('cliente', function ($query) use ($userId) {
            $query->where('usuario_id', $userId);
            $query->where('estado', 1);
        })->count();

        $newJobCount = Trabajo::whereHas('cliente', function($query) use ($userId) {
            $query->where('usuario_id', $userId);
            $query->where('estado', 1);
        })->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
            
        $totalGastos = Gasto::where('usuario_id', $userId)->sum('costo');

        $GastosMes = Gasto::where('usuario_id', $userId)
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->sum('costo');



        
        return view('livewire.tabla-datos', compact('newClientsCount', 'clientCount','jobCount','newJobCount','totalGastos','GastosMes'));
    }
}
