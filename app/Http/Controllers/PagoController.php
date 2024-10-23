<?php

namespace App\Http\Controllers;

use App\Models\ordenpago;
use App\Models\pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ordenpago.pagados');
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

        $existingPago = pago::where('ordenpago_id', $request->trabajo_id)
            ->where('fecha', $request->fecha)
            ->where('pago', $request->pago)
            ->first();

        if ($existingPago) {
            return redirect()->route('pagoCreate', Crypt::encrypt($request->trabajo_id))->with('msj', 'duplicado');
        }

        DB::transaction(function () use ($request) {
            $pago = new pago();
            $pago->pago = $request->pago;
            $pago->fecha = $request->fecha;
            $pago->ordenpago_id = $request->trabajo_id;

            $ordenpago = ordenpago::findOrFail($request->trabajo_id);

            if ($ordenpago->saldo == $request->pago) {
                $ordenpago->estadopago_id = 1;
            }

            if ($ordenpago->saldo >= $request->pago) {
                $ordenpago->cuenta = $ordenpago->cuenta + $request->pago;
                $ordenpago->saldo = $ordenpago->saldo - $request->pago;
                $pago->save();
                $ordenpago->update();
            }
        });

        return redirect()->route('pagoCreate', Crypt::encrypt($request->trabajo_id))->with('msj', 'ok');
    }

    public function pdf($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $ordenpago = Ordenpago::findOrFail($id);
        $pagos = Pago::where('ordenpago_id', $ordenpago->id)->get();
        $total = pago::where('ordenpago_id',  $ordenpago->id)->sum('pago');

        $user = Auth::user();


        $pdf = Pdf::loadView('ordenpago.totalpdf', ['user' => $user, 'pagos' => $pagos,'total'=>$total]);

        return $pdf->stream();
    }

    public function pdfsuelto($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $pago = pago::findOrFail($id);
        
        $user = Auth::user();

        $pdf = Pdf::loadView('ordenpago.sueltopdf', ['user' => $user,'pago'=>$pago ]);

        return $pdf->stream();
        
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
