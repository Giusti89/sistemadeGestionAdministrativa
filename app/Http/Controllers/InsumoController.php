<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\ordenpago;
use App\Models\Trabajo;
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


    public function destroy(Request $request, $id)
    {
        try {
            $cot = Insumo::findOrFail($id);
            $this->authorize('view', $cot);
            $cot->delete();
            return redirect()->route('insumoIndex', ['id' => $cot->trabajo_id])->with('chk', 'realizado');
        } catch (Exception $e) {
            return redirect()->route('insumoIndex', ['id' => $cot->trabajo_id])->with(['msj' => 'prohibido']);
        }
    }
    public function terminar(Request $request)
    {
        $actualizar = Trabajo::findOrFail($request->id);
        $ordendopago =new ordenpago();
        $ordendopago->trabajo_id=$request->id; 

        $ordendopago->fechpago= now();         
        


        $costoProduccion = $request->total;
        $actualizar->Costoproduccion= $costoProduccion;
        $porcentaje = $actualizar->ganancia / 100;
        $total = $costoProduccion + ($costoProduccion * $porcentaje);
        $ganefec = ($total - $costoProduccion);
        $actualizar->gananciaefectivo = $ganefec;
        $actualizar->estado = true;


        if ($actualizar->iva <= 0) {

            $actualizar->estado = true;
            $actualizar->Costoproduccion = $request->total;
            $actualizar->Costofinal = $total;

            $ordendopago->total=$total;
            $ordendopago->saldo=$total;


            $ordendopago->save();
            $actualizar->update();
            return redirect()->route('trabIndex')->with('chk', 'realizado');
        } else {

            $impuesto = $actualizar->iva / 100;
            $Costofac = $total + ($total * $impuesto);
            $actualizar->Costofinal = $Costofac;
            $actualizar->ivaefectivo=($Costofac-$total );

            $ordendopago->total=$Costofac;
            $ordendopago->saldo=$Costofac;
            
            $ordendopago->save();
            $actualizar->update();
            return redirect()->route('trabIndex')->with('chk', 'realizado');
        }
       
    }
}
