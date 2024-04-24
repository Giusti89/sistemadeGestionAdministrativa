<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('clientes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['nullable', 'string', 'max:255'],
            'contacto' => ['required', 'numeric'],
            'nit' => ['required', 'numeric'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $cliente = new Cliente();

        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->contacto = $request->contacto;
        $cliente->nit = $request->nit;
        $cliente->email = $request->email;
        $cliente->usuario_id = $request->usuario_id;

        $cliente->save();


        return redirect()->route('clientIndex')->with('success', 'ok');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $clie = Cliente::find($id);
        $this->authorize('autor', $clie);
        return view('clientes.edit', compact('clie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'contacto' => 'required|string|max:255',
            'nit' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);


        $clie = Cliente::find($id);
        $this->authorize('autor', $clie);


        $clie->nombre = $request->nombre;
        $clie->apellido = $request->apellido;
        $clie->contacto = $request->contacto;
        $clie->nit = $request->nit;
        $clie->email = $request->email;

        // Guardar los cambios en la base de datos
        $clie->save();

        // Redirigir a la ruta 'dashboard'
        return redirect()->route('clientIndex')->with('msj', 'cambio');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $this->authorize('autor', $cliente);
            $cliente->delete(); 
            return redirect()->route('clientIndex')->with('msj', 'ok');
        } catch (Exception $e) {
            return redirect()->route('clientIndex')->with(['msj' => 'prohibido']);
        }
    }
}
