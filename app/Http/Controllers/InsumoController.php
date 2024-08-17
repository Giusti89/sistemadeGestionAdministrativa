<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\ordenpago;
use App\Models\Trabajo;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Crypt;

class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($encryptedId)
    {
        try {
            $identificador = Crypt::decrypt($encryptedId);
            $trabajo = Trabajo::find($identificador);
            $this->authorize('trabajoID', $trabajo);

            return view('insumos.index', compact('identificador'));
        } catch (\Throwable $th) {
            return redirect()->route('trabIndex')->with(['msj' => 'prohibido']);
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
        $request->validate([
            'cantidad' => 'required',
            'insumo' => 'required|string|max:255',
            'costo' => 'required|numeric|between:0,999999.99',
            'detalle' => 'nullable|string|max:255',
        ], [
            'insumo.required' => 'El nombre del insumo es obligatorio.',
            'costo.required' => 'El costo es obligatorio.',
            'costo.numeric' => 'El costo debe ser un número.',
            'costo.between' => 'El costo debe estar entre 0 y 999999.99.',
        ]);
        try {
            $identificador = Crypt::decrypt($request->trabajo_id);
            $item = new Insumo();

            $item->nombre = $request->insumo;
            $item->cantidad = $request->cantidad;
            $item->detalle = $request->detalle;
            $item->costo = $request->costo;
            $item->trabajo_id = $identificador;
            $item->save();

            return redirect()->route('insumoIndex', ['id' => $request->trabajo_id])->with('msj', 'cambio');
        } catch (\Throwable $th) {
            return redirect()->route('insumoIndex', ['encryptedId' => $request->trabajo_id])->withErrors('Identificador inválido.');
        }
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
    public function edit($encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $coti = Insumo::find($id);
            $this->authorize('view', $coti);
            return view('insumos.edit', compact('coti'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required',
            'insumo' => 'string|max:255',
            'costo' => 'numeric|between:0,999999.99',
            'detalle' => 'nullable|string|max:255',
        ], [
            'insumo.required' => 'El nombre del insumo es obligatorio.',
            'costo.required' => 'El costo es obligatorio.',
            'costo.numeric' => 'El costo debe ser un número.',
            'costo.between' => 'El costo debe estar entre 0 y 999999.99.',
        ]);

        try {
            $insumo = Insumo::find($id);
            $this->authorize('view', $insumo);
            $insumo->cantidad = $request->cantidad;
            $insumo->nombre = $request->nombre;
            $insumo->detalle = $request->detalle;
            $insumo->costo = $request->costo;
    
            $encryptedId = Crypt::encrypt($insumo->trabajo_id);
            $insumo->save();
            return redirect()->route('insumoIndex', ['id' => $encryptedId])->with('chk', 'realizado');
        } catch (\Throwable $th) {
            return redirect()->route('insumoIndex', ['encryptedId' => $request->trabajo_id])->withErrors('Identificador inválido.');
        }
       
       
    }


    public function destroy(Request $request, $id)
    {
        try {

            $cot = Insumo::findOrFail($id);
            $this->authorize('view', $cot);
            $cot->delete();

            $encryptedId = Crypt::encrypt($cot->trabajo_id);

            return redirect()->route('insumoIndex', ['id' => $encryptedId])->with('chk', 'realizado');
        } catch (Exception $e) {
            return redirect()->route('insumoIndex')->with(['msj' => 'prohibido']);
        }
    }

    public function terminar(Request $request)
    {
        try {
            $actualizar = Trabajo::findOrFail($request->id);
            $ordendopago = new OrdenPago();
            $ordendopago->trabajo_id = $request->id;

            $costoProduccion = $request->total;
            $actualizar->Costoproduccion = $costoProduccion;

            $porcentajeGanancia = $actualizar->ganancia / 100;
            $gananciaEfectivo = $costoProduccion * $porcentajeGanancia;
            $totalConGanancia = $costoProduccion + $gananciaEfectivo;

            if ($actualizar->iva > 0) {
                $porcentajeIva = $actualizar->iva / 100;
                $montoIva = $totalConGanancia * $porcentajeIva;
                $totalFinal = $totalConGanancia + $montoIva;
                $actualizar->ivaefectivo = $montoIva;
            } else {
                $totalFinal = $totalConGanancia;
            }

            $actualizar->gananciaefectivo = $gananciaEfectivo;
            $actualizar->Costofinal = $totalFinal;
            $actualizar->estado = true;

            $ordendopago->total = $totalFinal;
            $ordendopago->saldo = $totalFinal;

            $ordendopago->save();
            $actualizar->update();

            return redirect()->route('trabIndex')->with('chk', 'realizado');
        } catch (Exception $e) {
            return redirect()->route('trabIndex')->with('error', 'Ocurrió un error al procesar el trabajo.');
        }
    }
}
