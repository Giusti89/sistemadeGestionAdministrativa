<link rel="stylesheet" href="./css/registro.css">

<x-guest-layout>
    <section>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name">Nombre</label>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <label for="name">Apellido</label>
                <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')"
                    required autofocus autocomplete="lastname" />
                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="TipoUsuario">Tipo usuario</label>
                <select id="tipousuario" name="tipousuario" class="selector w-full" required autofocus
                    autocomplete="tipousuario">
                    <option value=""></option>
                    @foreach ($tipo as $nombre => $id)
                        <option value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('tipousuario')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email">Email</label>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="mensual">Suscripcion mensual</label>
                <x-text-input id="mensual" class="block mt-1 w-full" type="number" name="mensual" :value="old('mensual')"
                    autocomplete="mensual" />
                <x-input-error :messages="$errors->get('subscription_end')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="anual">Suscripcion anual</label>
                <x-text-input id="anual" class="block mt-1 w-full" type="number" name="anual" :value="old('anual')"
                    autocomplete="anual" />
                <x-input-error :messages="$errors->get('subscription_end')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password">Password</label>

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="Confirmar password"> Confirmar password</label>

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('adminIndex') }}">
                    {{ __('Regresar') }}
                </a>


            </div>
        </form>
    </section>
</x-guest-layout>
