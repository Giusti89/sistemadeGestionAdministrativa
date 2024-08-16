<x-layouts.nuevos titulo="Nuevos Clientes" css="../css/nuevoTrabajo.css">
    
    <section>
        <form method="POST" action="{{ route('updateTrab', $trab->id) }}">

            @csrf
            @method('PUT')
            <h1>Nuevo Trabajo</h1>
           

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text"  id="trabajo" name="trabajo" value="{{$trab->trabajo}}"  autofocus
                    autocomplete="trabajo">
                <label for="">Trabajo/Servicio</label>
                <x-input-error :messages="$errors->get('trabajo')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="descripcion" :value="__('Descripcion')" style="color: white;font-size:1.5rem" /> <br>
                <textarea style="padding: 9px" name="descripcion" id="descripcion" cols="30" rows="10">{{$trab->descripcion}}</textarea>
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="number"  id="cantidades" name="cantidades"  value="{{$trab->cantidad}}" 
                    autofocus autocomplete="cantidades">
                <label for="">Cantidad</label>
                <x-input-error :messages="$errors->get('cantidades')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="number"  id="ganancia" name="ganancia" value="{{$trab->ganancia}}"  autofocus
                    autocomplete="ganancia">
                <label for="">Ganancia</label>
                <x-input-error :messages="$errors->get('ganancia')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="number"  id="manobra" name="manobra" value="{{$trab->manobra}}"  autofocus
                    autocomplete="manobra">
                <label for="">Mano de obra</label>
                <x-input-error :messages="$errors->get('manobra')" class="mt-2" />
            </div>

            <button>
                <p>Registrar</p>
            </button>

            <div class="forget">
                <a href="{{ route('trabIndex') }}">Regresar</a>
            </div>
        </form>
    </section>

</x-layouts.nuevos>