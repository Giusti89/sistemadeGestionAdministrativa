<x-layouts.nuevos titulo="Nuevos Clientes" css="./css/nuevoTrabajo.css">
    <div class="contenedor">
        <section>
            <form method="POST" action="{{ route('crearTrab') }}">
                @csrf
                <h1>Nuevo Trabajo</h1>

                <div class="mt-4">
                    <x-input-label for="Cliente" :value="__('Cliente ')" style="color: white;font-size:1.5rem" />
                    <select id="cliente" name="cliente" class="selector" required  autocomplete="cliente">
                        <option value=""></option>
                        @foreach ($cliente as $nombre => $id)
                            <option value="{{ $id }}">{{ $nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('cliente')" class="mt-2" />
                </div>

                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="text" required id="trabajo" name="trabajo" :value="old('trabajo')" autofocus
                        autocomplete="trabajo">
                    <label for="">Trabajo/Servicio</label>
                    <x-input-error :messages="$errors->get('trabajo')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="descripcion" :value="__('Descripcion')" style="color: white;font-size:1.5rem" /> <br>
                    <textarea placeholder="ingresar la descripción del trabajo a realizar" name="descripcion" id="descripcion" cols="20" rows="10" style="padding:9px;"></textarea>
                </div>

                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="number" required id="cantidades" name="cantidades" :value="old('cantidades')"
                        autofocus autocomplete="cantidades">
                    <label for="">Cantidad</label>
                    <x-input-error :messages="$errors->get('cantidades')" class="mt-2" />
                </div>

                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="decimal" required id="ganancia" name="ganancia" :value="old('ganancia')" autofocus
                        autocomplete="ganancia">
                    <label for="">Ganancia del trabajo (solo numeral)</label>
                    <x-input-error :messages="$errors->get('ganancia')" class="mt-2" />
                </div>

                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="decimal" required id="manobra" name="manobra" :value="old('manobra')" autofocus
                        autocomplete="manobra">
                    <label for="">Mano de obra</label>
                    <x-input-error :messages="$errors->get('manobra')" class="mt-2" />
                </div>

                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="number"  id="iva" name="iva" value="0" autofocus
                        autocomplete="iva">
                    <label for="">IVA</label>
                    <x-input-error :messages="$errors->get('iva')" class="mt-2" />
                </div>

                <button>
                    <p>Registrar</p>
                </button>

                <div class="forget">
                    <a href="{{ route('trabIndex') }}">Regresar</a>
                </div>
            </form>
        </section>
    </div>


</x-layouts.nuevos>
