<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;
use Exception;

class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($identificador)
    {
        return view('insumos.index', compact('identificador'));
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
        $item = new Insumo();

        $item->nombre = $request->insumo;
        $item->detalle = $request->detalle;
        $item->costo = $request->costo;
        $item->trabajo_id = $request->trabajo_id;
        $item->save();
        
        return redirect()->route('insumoIndex', ['id' => $request->trabajo_id])->with('msj', 'cambio');
    }

    /**
     * Display the specified resource.
     */
    public function show(Insumo $insumo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $coti = Insumo::find($id);
        $this->authorize('view', $coti);
        return view('insumos.edit', compact('coti'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'detalle' => 'nullable|string|max:255',
            'costo' => 'required|string|max:255',

        ]);

        $insumo = Insumo::find($id);
        $this->authorize('view', $insumo);
        $insumo->nombre = $request->nombre;
        $insumo->detalle = $request->detalle;
        $insumo->costo = $request->costo;

        
        $insumo->update();
        return redirect()->route('insumoIndex', ['id' => $insumo->trabajo_id])->with('msj', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $cot = Insumo::findOrFail($id);
            $this->authorize('view', $cot);
            $cot->delete();
            return redirect()->route('insumoIndex', ['id' => $cot->trabajo_id])->with('msj', 'ok');
        } catch (Exception $e) {
            return redirect()->route('insumoIndex', ['id' => $cot->trabajo_id])->with(['msj' => 'prohibido']);
        }
    }
}
