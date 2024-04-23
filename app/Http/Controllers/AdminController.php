<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('administracion.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usucli=User::find($id);
        $suscrip= $usucli->suscripcion;
        return view('administracion.edit',compact('usucli','suscrip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8', 
            'mensual' => 'nullable|integer|min:1',
            'anual' => 'nullable|integer|min:1',
            'suscripcion' => 'nullable|boolean',
        ]);

        $usucli=User::findOrFail($id);

        if ($request->has('mensual')) {
            $final = Carbon::parse($usucli->final)->addMonths($request->mensual);
            $usucli->update(['final' => $final]);
        }


        if ($request->has('anual')) {
            $final = Carbon::parse($usucli->final)->addYears($request->anual);
            $usucli->update(['final' => $final]);
        }
        
        if ($request->filled('password')) {
            $pass = Hash::make($request->password);
            $usucli->update(['password' => $pass]);
        }

        if ($request->has('suscripcion')) {
            $sus = $request->suscripcion === '1' ? true : false;
            $usucli->update(['suscripcion' => $sus]);
        }
        
        $usucli->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'final' => $usucli->final, 
        ]);
       
        return redirect()->route('adminIndex')->with('msj', 'cambio');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $usucli=User::findOrFail($id);
            $usucli->delete();
            return redirect()->route('adminIndex')->with('msj', 'ok');
        } catch (\Throwable $th) {
            return redirect()->route('adminIndex')->with('success', 'ok');
        }
    }
}
