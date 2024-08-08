<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\ordenpago;
use App\Models\pago;
use App\Models\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

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
    public function create($encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);

            $ordenpago = ordenpago::findOrFail($id);

            $idtrabajo = $ordenpago->trabajo_id;

            $pago = Pago::where('ordenpago_id', $ordenpago->id)->get();

            $trab = Trabajo::findOrFail($idtrabajo);

            $this->authorize('trabajoID', $trab);

            $ordenes = Ordenpago::where('trabajo_id', $id)->get();

            return view('ordenpago.pago', compact('ordenpago', 'trab', 'pago'));
        } catch (\Throwable $th) {
            return Redirect::route('pagoIndex')->with('msj', 'error');
        }
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
    public function show($encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $ordenpago = Ordenpago::findOrFail($id);
            $pago = Pago::where('ordenpago_id', $ordenpago->id)->get();

            return view('ordenpago.cuentapagada', compact('pago', 'ordenpago'));
        } catch (\Throwable $th) {
            return Redirect::route('pagoPagados')->with('msj', 'error');
        }
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
