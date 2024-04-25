<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'ganancia' => 'required|numeric'
        ]);

        $trabajo = new Trabajo();

        $trabajo->trabajo = $request->trabajo;
        $trabajo->ganancia = $request->ganancia;
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
                  
        $this->authorize('trabajoID',$trab);
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
        $this->authorize('trabajoID',$id);  
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
