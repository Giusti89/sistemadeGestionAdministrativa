<x-guest-layout>
    <link rel="stylesheet" href="./css/loginn.css">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <section>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Inicio</h1>
            @if ($errors->has('subscription'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ $errors->first('subscription') }}
                </div>
            @endif
            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" required id="email" name="email" :value="old('email')" required autofocus
                    autocomplete="username">
                <label for="">Usuario/Email</label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="password" required id="password" name="password" autocomplete="current-password">
                <label for="">Contraseña</label>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <button>
                <p>Ingresar</p>
            </button>
            <div class="forget">
                <a href="{{ route('password.request') }}">Olvide la contraseña</a>
            </div>
        </form>
    </section>

</x-guest-layout>
