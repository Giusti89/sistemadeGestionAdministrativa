<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('clientes.index');
        } catch (\Throwable $th) {
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('clientes.nuevo');
        } catch (\Throwable $th) {
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'apellido' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'contacto' => 'required|numeric',
            'nit' => 'required|max:255',
            'email' => 'required|email|max:255',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',

            'apellido.string' => 'El apellido debe ser una cadena de texto.',
            'apellido.max' => 'El apellido no debe exceder los 255 caracteres.',
            'apellido.regex' => 'El apellido solo puede contener letras y espacios.',

            'contacto.required' => 'El contacto es obligatorio.',
            'contacto.numeric' => 'El contacto debe ser un número.',
            'contacto.max' => 'El contacto no debe exceder los 255 caracteres.',

            'nit.required' => 'El NIT es obligatorio.',
            'nit.max' => 'El NIT no debe exceder los 255 caracteres.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.max' => 'El correo electrónico no debe exceder los 255 caracteres.',
        ]);
        try {
            $cliente = new Cliente();

            $cliente->nombre = $request->nombre;
            $cliente->apellido = $request->apellido;
            $cliente->contacto = $request->contacto;
            $cliente->nit = $request->nit;
            $cliente->email = $request->email;
            $cliente->usuario_id = $request->usuario_id;
            $cliente->save();
            return redirect()->route('clientIndex')->with('msj', 'cambio');
        } catch (\Throwable $th) {
            return view('clientes.index')->with('msj', 'error');
        }
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
    public function edit(string $encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $clie = Cliente::find($id);
            $this->authorize('autor', $clie);
            return view('clientes.edit', compact('clie'));
        } catch (\Throwable $th) {
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'contacto' => 'required|string|max:255',
            'nit' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        try {
            $clie = Cliente::find($id);
            $this->authorize('autor', $clie);    
    
            $clie->nombre = $request->nombre;
            $clie->apellido = $request->apellido;
            $clie->contacto = $request->contacto;
            $clie->nit = $request->nit;
            $clie->email = $request->email;   

            $clie->save();     
                      
            return redirect()->route('clientIndex')->with('msj', 'cambio');
        } catch (\Throwable $th) {
            return redirect()->route('clientIndex')->with('msj', 'error');
        }      
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
