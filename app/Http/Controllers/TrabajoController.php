<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
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
        try {
            return view('trabajos.index');
        } catch (\Throwable $th) {
            return redirect()->route('trabIndex')->with(['msj' => 'prohibido']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $user = Auth::user();
            $cliente = $user->clientes->pluck('id', 'nombre');
            return view('trabajos.nuevo', compact('cliente'));
        } catch (\Throwable $th) {
            return redirect()->route('trabIndex')->with(['msj' => 'prohibido']);
        }
    }

    public function pdf($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        $items = Insumo::where('trabajo_id', $trabajo->id)->get();
        $total = Insumo::where('trabajo_id',  $trabajo->id)->sum('costo');
        $pdf = Pdf::loadView('trabajos.reporte', ['trabajo' => $trabajo, 'items' => $items, 'total' => $total]);

        return $pdf->stream();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'trabajo' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'descripcion' => 'required|string',
            'cliente' => 'required|exists:clientes,id',
            'cantidades' => 'required|numeric|max_digits:10|min:1',
            'ganancia' => 'required|numeric|max_digits:10|min:1',
            'manobra' => 'required|numeric|max_digits:10|min:1',
            'iva' => 'numeric|nullable|max_digits:3|min:0',
        ], [
            'trabajo.required' => 'El nombre del trabajo es obligatorio.',
            'trabajo.string' => 'El nombre del trabajo debe ser una cadena de texto.',
            'trabajo.max' => 'El nombre del trabajo no debe exceder los 255 caracteres.',
            'trabajo.regex' => 'El trabajo solo puede contener letras y espacios.',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',

            'cliente.required' => 'El cliente es obligatorio.',
            'cliente.exists' => 'El cliente seleccionado no existe en la base de datos.',

            'cantidades.required' => 'La cantidad es obligatoria.',
            'cantidades.numeric' => 'La cantidad debe ser un número.',
            'cantidades.max_digits' => 'El cantidad no debe exceder los 10 dígitos.',
            'cantidades.min' => 'El cantidad debe ser un número positivo.',

            'ganancia.required' => 'La ganancia es obligatoria.',
            'ganancia.numeric' => 'La ganancia debe ser un número.',
            'ganancia.max_digits' => 'La ganancia no debe exceder los 10 dígitos.',
            'ganancia.min' => 'El cantidad debe ser un número positivo.',

            'manobra.numeric' => 'La mano de obra debe ser un número.',
            'manobra.required' => 'La mano de obra es obligatoria.',
            'manobra.max_digits' => 'La mano de obra no debe exceder los 10 dígitos.',
            'manobra.min' => 'La mano de obra debe ser un número positivo.',


            'iva.numeric' => 'El IVA debe ser un número.',
            'iva.min' => 'El cantidad debe ser un número positivo.',
            'iva.max_digits' => 'El IVA no debe exceder los 3 dígitos.',
        ]);

        $trabajo = new Trabajo();

        $trabajo->trabajo = $request->trabajo;
        $trabajo->ganancia = $request->ganancia;
        $trabajo->iva = $request->iva;
        $trabajo->descripcion = $request->descripcion;
        $trabajo->cliente_id = $request->cliente;
        $trabajo->cantidad = $request->cantidades;
        $trabajo->manobra = $request->manobra;

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
            'cantidades' => [
                'required',
                'numeric',
                'between:0,9999999999.99',
                'regex:/^\d+(\.\d{1,2})?$/',
            ],
            'ganancia' => [
                'required',
                'numeric',
                'between:0,9999999999.99',
                'regex:/^\d+(\.\d{1,2})?$/',
            ],
            'manobra' => [
                'required',
                'numeric',
                'between:0,9999999999.99',
                'regex:/^\d+(\.\d{1,2})?$/',
            ],
        ], [
            'cantidades.between' => 'La cantidad no debe superar los 10 dígitos en total, incluyendo los decimales.',
            'cantidades.regex' => 'La cantidad debe ser un número decimal positivo.',
        ]);
        $this->authorize('trabajoID', $id);
        $id->trabajo = $request->trabajo;
        $id->descripcion = $request->descripcion;
        $id->cantidad = $request->cantidades;
        $id->manobra = $request->manobra;

        $id->update();
        return redirect()->route('trabIndex')->with('msj', 'cambio');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $trabajo = Trabajo::with('insumos')->findOrFail($id);


            if ($trabajo->insumos->isNotEmpty()) {
                return redirect()->route('trabIndex')->with('msj', 'prohibido');
            }
            $this->authorize('trabajoID', $trabajo);
            $trabajo->delete();
            return redirect()->route('trabIndex')->with('msj', 'ok');
        } catch (Exception $e) {
            return redirect()->route('trabIndex')->with(['msj' => 'prohibido']);
        }
    }
}
