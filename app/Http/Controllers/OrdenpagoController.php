<?php

namespace App\Http\Controllers;

use App\Models\ordenpago;
use App\Models\pago;
use App\Models\Trabajo;
use Illuminate\Http\Request;

class OrdenpagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ordenpago.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $ordenpago = ordenpago::findOrFail($id);
        
        $idtrabajo=$ordenpago->trabajo_id;
        
        $pago = Pago::where('ordenpago_id', $ordenpago->id)->get();

        $trab=Trabajo::findOrFail($idtrabajo);

        $this->authorize('trabajoID', $trab);

        $ordenes = Ordenpago::where('trabajo_id', $id)->get();
        
        return view('ordenpago.pago', compact('ordenpago', 'trab','pago'));
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
    public function show(ordenpago $ordenpago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ordenpago $ordenpago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ordenpago $ordenpago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ordenpago $ordenpago)
    {
        //
    }
}
