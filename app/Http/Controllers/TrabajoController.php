<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;


class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('trabajos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $cliente = $user->clientes->pluck('id', 'nombre');

        return view('trabajos.nuevo', compact('cliente'));
    }

    public function pdf($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        $pdf = Pdf::loadView('trabajos.reporte', ['trabajo'=>$trabajo]);  
        
        return $pdf->stream();
           
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'trabajo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'cliente' => 'required|exists:clientes,id',
            'cantidades' => 'required|numeric',
            'ganancia' => 'required|numeric',
            'iva' => 'numeric|nullable',
        ], [
            'trabajo.required' => 'El nombre del trabajo es obligatorio.',
            'trabajo.string' => 'El nombre del trabajo debe ser una cadena de texto.',
            'trabajo.max' => 'El nombre del trabajo no debe exceder los 255 caracteres.',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',

            'cliente.required' => 'El cliente es obligatorio.',
            'cliente.exists' => 'El cliente seleccionado no existe en la base de datos.',

            'cantidades.required' => 'La cantidad es obligatoria.',
            'cantidades.numeric' => 'La cantidad debe ser un número.',

            'ganancia.required' => 'La ganancia es obligatoria.',
            'ganancia.numeric' => 'La ganancia debe ser un número.',

            'iva.numeric' => 'El IVA debe ser un número.',
        ]);

        $trabajo = new Trabajo();

        $trabajo->trabajo = $request->trabajo;
        $trabajo->ganancia = $request->ganancia;
        $trabajo->iva = $request->iva;
        $trabajo->descripcion = $request->descripcion;
        $trabajo->cliente_id = $request->cliente;
        $trabajo->cantidad = $request->cantidades;

        $trabajo->save();

        return redirect()->route('trabIndex')->with('msj', 'cambio');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trabajo $trabajo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $trab = Trabajo::find($id);

        $this->authorize('trabajoID', $trab);
        return view('trabajos.edit', compact('trab'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trabajo $id)
    {
        $request->validate([
            'trabajo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'cantidades' => 'required|numeric',
        ]);
        $this->authorize('trabajoID', $id);
        $id->trabajo = $request->trabajo;
        $id->descripcion = $request->descripcion;
        $id->cantidad = $request->cantidades;

        $id->update();
        return redirect()->route('trabIndex')->with('msj', 'cambio');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trabajo $id)
    {
        try {
            $this->authorize('trabajoID', $id);

            $id->delete();

            return redirect()->route('trabIndex')->with('msj', 'ok');
        } catch (Exception $e) {
            return redirect()->route('trabIndex')->with('msj', 'prohibido');
        }
    }
}
