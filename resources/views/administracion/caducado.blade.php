<x-layouts.nuevos titulo="Modificar Clientes" css="../css/modusu.css">
    <section>
        
        <form method="POST" action="{{ route('adminRenovacion', $usucli->id) }}" >

            @csrf
            @method('PUT')

            <h1>Editar los datos del cliente</h1>

            <input type="hidden" name="usuario_id" value="{{ Auth::id() }}">

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text" id="name" name="name" value="Nombre: {{ $usucli->name }}" required autofocus
                    autocomplete="name" readonly>
                
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text" id="lastname" name="lastname" value="Apellido: {{ $usucli->lastname }}" required autofocus
                    autocomplete="lastname" readonly>
                
                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
            </div>


            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="number" id="mensual" name="mensual" autofocus autocomplete="mensual">
                <label for="">Agregar meses</label>
                <x-input-error :messages="$errors->get('mensual')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="number" id="anual" name="anual" autofocus autocomplete="anual">
                <label for="">Agregar años</label>
                <x-input-error :messages="$errors->get('anual')" class="mt-2" />
            </div>


            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <label for="">Activar suscripción </label> <br> <br> <br>
                <select id="suscripcion" name="suscripcion" class="selector w-full" required autofocus
                    autocomplete="suscripcion">
                    <option style="color: black" value="" selected disabled>Seleccionar</option>
                    <option style="color: black" value="1" {{ $suscrip === true ? 'selected' : '' }}>Activo
                    </option>
                    <option style="color: black" value="0" {{ $suscrip === false ? 'selected' : '' }}>Inactivo
                    </option>
                </select>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <button>
                <p>Modificar</p>
            </button>

            <div class="forget">
                <a href="{{ route('adminIndex') }}">Regresar</a>
            </div>
        </form>
    </section>


</x-layouts.nuevos>