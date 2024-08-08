<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
        try {
            $gasto = new Gasto();
            $gasto->concepto = $request->concepto;
            $gasto->descripcion = $request->descripcion;
            $gasto->costo = $request->costo;
            $gasto->fecha = $request->fecha;
            $gasto->usuario_id = Auth::id();

            $gasto->save();

            return redirect()->route('gastoIndex')->with('msj', 'cambio');
        } catch (\Throwable $th) {
            return redirect()->route('gastoIndex')->with('msj', 'error');
        }
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
    public function edit($encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $gasto = Gasto::findOrFail($id);
            
            return view('gastos.edit', compact('gasto'));
        } catch (\Throwable $th) {
            return redirect()->route('gastoIndex')->with('msj', 'error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $gasto = Gasto::findOrFail($id);
    
            $gasto->update([
                'concepto' => $request->concepto,
                'descripcion' => $request->descripcion,
                'costo' => $request->costo,
                'fecha' => $request->fecha
            ]);
    
            return redirect()->route('gastoIndex')->with('msj', 'ok');
        } catch (\Throwable $th) {
            return redirect()->route('gastoIndex')->with('msj', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $gasto = Gasto::findOrFail($id);
    
            // Verificar la contraseña del usuario
            if (! Hash::check($request->password, $request->user()->password)) {
                throw ValidationException::withMessages([
                    'password' => __('La contraseña proporcionada no es correcta.'),
                ]);
            }
        
            // Eliminar el gasto
            $gasto->delete();
        
            return redirect()->route('gastoIndex')->with('msj', 'ok');
        } catch (\Throwable $th) {
            return redirect()->route('gastoIndex')->with('msj', 'fallo');
        }
       
    }
}
