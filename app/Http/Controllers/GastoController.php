<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('gastos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gastos.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $gasto=new Gasto();
        $gasto->concepto=$request->concepto;
        $gasto->descripcion=$request->descripcion;
        $gasto->costo=$request->costo;
        $gasto->fecha=$request->fecha;
        $gasto->usuario_id = Auth::id();
        
        

        $gasto->save();

        return redirect()->route('gastoIndex')->with('msj', 'cambio');

    }

    /**
     * Display the specified resource.
     */
    public function show(Gasto $gasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gasto $gasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gasto $gasto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gasto $gasto)
    {
        //
    }
}
