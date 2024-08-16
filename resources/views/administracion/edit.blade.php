<x-layouts.nuevos titulo="Modificar Clientes" css="../css/modusu.css">
    <section>
       
        <form method="POST"  action="{{ route('adminUpdate', $usucli->id) }}">

            @csrf
            @method('PUT')

            <h1>Editar los datos del cliente</h1>

            <input type="hidden" name="usuario_id" value="{{ Auth::id() }}">

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text" id="name" name="name" value="{{ $usucli->name }}" required autofocus
                    autocomplete="name">
                <label style="color: red;font-size:1.5rem" for="">Nombre</label>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>           

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text" id="lastname" name="lastname" value="{{ $usucli->lastname }}" required autofocus
                    autocomplete="lastname">
                <label style="color: red;font-size:1.5rem" for="">Apellido</label>
                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="number" id="telefono" name="telefono" value="{{ $usucli->telefono }}" required autofocus
                    autocomplete="telefono">
                <label style="color: red;font-size:1.5rem" for="">Contacto</label>
                <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" id="email" name="email" value="{{ $usucli->email }}" required autofocus
                    autocomplete="contacto">
                <label style="color: red;font-size:1.5rem" for="">Email</label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="password" id="password" name="password" autofocus autocomplete="password">
                <label style="color: red;font-size:1.5rem" for="">Reiniciar password</label>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="date" id="final" name="final" value="{{ $usucli->final }}" required autofocus
                    autocomplete="final">
                <label style="color: red;font-size:1.5rem" for="">Fecha final suscripción</label>
                <x-input-error :messages="$errors->get('final')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="number" id="mensual" name="mensual" autofocus autocomplete="mensual">
                <label style="color: red;font-size:1.5rem" for="">Agregar meses</label>
                <x-input-error :messages="$errors->get('mensual')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="number" id="anual" name="anual" autofocus autocomplete="anual">
                <label style="color: red;font-size:1.5rem" for="">Agregar años</label>
                <x-input-error :messages="$errors->get('anual')" class="mt-2" />
            </div>


            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <label style="color: red;font-size:1.5rem" for="">Modificar suscripción </label> <br> <br> <br>
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