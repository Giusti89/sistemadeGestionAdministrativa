<?php

namespace App\Livewire;

use App\Models\Gasto;
use App\Models\ordenpago;
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

        //trabajos
        $jobCount = Trabajo::whereHas('cliente', function ($query) use ($userId) {
            $query->where('usuario_id', $userId);
            $query->where('estado', 1);
        })->count();

        $newJobCount = Trabajo::whereHas('cliente', function ($query) use ($userId) {
            $query->where('usuario_id', $userId);
            $query->where('estado', 1);
        })->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        //gastos    
        $totalGastos = Gasto::where('usuario_id', $userId)->sum('costo');

        $GastosMes = Gasto::where('usuario_id', $userId)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('costo');

        //ganancias
        $ganancias = Trabajo::whereHas('cliente', function ($query) use ($userId) {
            $query->where('usuario_id', $userId);
            $query->where('estado', 1);
        })->sum('gananciaefectivo');
        //perdidas

        $perdidas = Trabajo::whereHas('cliente', function ($query) use ($userId) {
            $query->where('usuario_id', $userId);
            $query->where('estado', 1);
        })->sum('ivaefectivo');

        $porpagar = OrdenPago::whereHas('trabajo.cliente', function ($query) use ($userId) {
            $query->where('usuario_id', $userId);
        })->where('estadopago_id', 2)->count();

        $pagados = OrdenPago::whereHas('trabajo.cliente', function ($query) use ($userId) {
            $query->where('usuario_id', $userId);
        })->where('estadopago_id', 1)->count();

        return view('livewire.tabla-datos', compact('newClientsCount', 'clientCount', 'jobCount', 'newJobCount', 'totalGastos', 'GastosMes', 'ganancias','perdidas','porpagar','pagados'));
    }
}
