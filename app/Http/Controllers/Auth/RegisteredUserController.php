<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tipousuario;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $tipo = Tipousuario::pluck('id', 'nombre');
        return view('auth.register', compact('tipo'));
        
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        
        $currentDate =  now();

        $addyears = $request->anual;
        $addmes = $request->mensual;

        if ($addyears > 0) {

            $currentDate->addYears($addyears);
        } elseif ($addmes > 0) {
            $currentDate->addMonths($addmes);
        }


        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipousuario_id' => $request->tipousuario,
            'inicio' => now(),
            'final' => $currentDate,
            'suscripcion' => '1',
        ]);
        $user->save();

        event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('pagoIndex');
    }
    public function isAdmin(User $user)
    {
        return $user->isAdmin();
    }
}
