<?php

namespace App\Http\Controllers;

use App\Models\ordenpago;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('cuentas.index');
        } catch (\Exception $e) {

            return response()->view('errors.500', [], 500);
        }
    }

    public function prueba()
    {
        try {
            $userId = auth()->user()->id;
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();

            $user = User::withCount('clientes')->find($userId);
            $clientCount = $user->clientes_count;

            $porpagar = ordenpago::whereHas('trabajo.cliente', function ($query) use ($userId) {
                $query->where('usuario_id', $userId);
            })->where('estadopago_id', 2)->count();

            $pagados = OrdenPago::whereHas('trabajo.cliente', function ($query) use ($userId) {
                $query->where('usuario_id', $userId);
            })->where('estadopago_id', 1)->count();

            $newClientsCount = User::find($userId)->clientes()
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();

            $ordenesPorMes = DB::table('ordenpagos')
                ->join('trabajos', 'ordenpagos.trabajo_id', '=', 'trabajos.id')
                ->join('clientes', 'trabajos.cliente_id', '=', 'clientes.id')
                ->where('clientes.usuario_id', $userId)
                ->where('ordenpagos.estadopago_id', 1)
                ->select(DB::raw('MONTH(ordenpagos.created_at) as mes'), DB::raw('count(*) as total'))
                ->groupBy('mes')
                ->pluck('total', 'mes')->all();

            // Llenar los meses que no tienen valores con 0
            $ordenesPorMes = array_replace(array_fill(1, 12, 0), $ordenesPorMes);


            $trabajosPorMes = DB::table('trabajos')
                ->join('clientes', 'trabajos.cliente_id', '=', 'clientes.id')
                ->where('clientes.usuario_id', $userId)
                ->select(DB::raw('MONTH(trabajos.created_at) as mes'), DB::raw('count(*) as total'))
                ->groupBy('mes')
                ->pluck('total', 'mes')->all();

            $trabajosPorMes = array_replace(array_fill(1, 12, 0), $trabajosPorMes);

            return view('cuentas.estadistica', compact('clientCount', 'newClientsCount', 'porpagar', 'pagados', 'ordenesPorMes', 'trabajosPorMes'));


            return view('cuentas.estadistica', compact('clientCount', 'newClientsCount', 'porpagar', 'pagados', 'ordenesPorMes', 'trabajosPorMes'));
        } catch (\Exception $e) {
            // Captura y muestra el error

            $errorMessage = $e->getMessage();
            return view('errors.500', compact('errorMessage'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
