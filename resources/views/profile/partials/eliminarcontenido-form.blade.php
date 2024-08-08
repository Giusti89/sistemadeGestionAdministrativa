<section class="space-y-6">
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-gasto-deletion-{{ $gastoId }}')"
    >{{ __('Eliminar Gasto') }}</x-danger-button>

    <x-modal name="confirm-gasto-deletion-{{ $gastoId }}" :show="$errors->gastoDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('gasto.destroy', $gastoId) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('¿Estás seguro de que quieres eliminar este gasto?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Una vez que se elimine, no podrás recuperarlo. Por favor, ingresa tu contraseña para confirmar.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Contraseña') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Contraseña') }}"
                />

                <x-input-error :messages="$errors->gastoDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <div class="forget">
                    <a href="{{ route('gastoIndex') }}">Cancelar</a>
                </div>

                <x-danger-button class="ms-3">
                    {{ __('Eliminar Gasto') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
