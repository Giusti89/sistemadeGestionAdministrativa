<?php

namespace App\Http\Controllers;

use App\Models\ordenpago;
use App\Models\pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $request->validate([
            'pago' => 'required|numeric|min:0',
            'fecha' => 'required|date',
            'trabajo_id' => 'required|exists:ordenpagos,id',          
        ]);

        $pago=new pago();
        $pago->pago = $request->pago;
        $pago->fecha = $request->fecha;
        $pago->ordenpago_id = $request->trabajo_id;

        $ordenpago=ordenpago::findOrFail( $request->trabajo_id);

        if ( $ordenpago->saldo >= $request->pago) {
            $ordenpago->cuenta = $ordenpago->cuenta + $request->pago;
            $ordenpago->saldo =$ordenpago->saldo - $request->pago;
            // $saldo= $ordenpago->saldo;
             $pago->save();
             $ordenpago->update();
    
             return redirect()->route('pagoCreate', ['id' => $request->trabajo_id])->with('msj', 'cambio');
        }
        return redirect()->route('pagoIndex')->with('msj', 'error');
    }

    /**
     * Display the specified resource.
     */
    public function show(pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pago $pago)
    {
        //
    }
}
