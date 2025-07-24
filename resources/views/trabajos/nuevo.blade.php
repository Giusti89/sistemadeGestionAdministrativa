<x-layouts.nuevos titulo="Nuevo Trabajo" css="../css/nuevoTrabajo.css">
    <h1 class="titulo">Nuevo Trabajo</h1>
    <div class="contenedor">

        <form method="POST" action="{{ route('crearTrab') }}">
            @csrf
            <div class="formulario">

                <div class="mt-4">
                    <div class="contenido">
                        <label class="subtitulo" for="Cliente">Cliente:</label>
                        <select id="cliente" name="cliente" class="selector" required autocomplete="cliente">
                            <option value=""></option>
                            @foreach ($cliente as $nombre => $id)
                                <option value="{{ $id }}" style="font-size: 1.5rem">{{ $nombre }}
                                </option>
                            @endforeach
                        </select>
                        <div class="tooltip">?
                            <span class="tooltiptext">Seleccione un cliente de la lista</span>
                        </div>
                        <x-input-error :messages="$errors->get('cliente')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4">
                    <div class="contenido">
                        <label class="subtitulo" for="trabajo">Trabajo/Servicio:</label>
                        <x-input-error :messages="$errors->get('trabajo')" class="mt-2" />
                        <input class="datos" type="text" required id="trabajo" name="trabajo"
                            :value="old('trabajo')" autofocus autocomplete="trabajo" />
                        <div class="tooltip">?
                            <span class="tooltiptext">Nombre del trabajo o servicio que se va realizar</span>
                        </div>
                    </div>
                </div>

                <div class="cortos">
                    <div class="mt-4">
                        <div class="contenido">
                            <label class="subtitulo" for="manobra">Mano de obra:</label>
                            <x-input-error :messages="$errors->get('manobra')" class="mt-2" />
                            <input class="datos" type="decimal" required id="manobra" name="manobra"
                                :value="old('manobra')" autofocus autocomplete="manobra">
                            <div class="tooltip">?
                                <span class="tooltiptext">Ingresar el costo de su mano de obra</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="contenido">
                            <label class="subtitulo" for="ganancia">Porcentaje sobre costo producción:</label>
                            <x-input-error :messages="$errors->get('ganancia')" class="mt-2" />
                            <input class="datos" type="decimal" required id="ganancia" name="ganancia"
                                :value="old('ganancia')" autofocus autocomplete="ganancia">
                            <div class="tooltip">?
                                <span class="tooltiptext">Ingresar el porcentaje de ganancia a ganar sobre los insumos a
                                    ser empleados</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cortos">
                    <div class="mt-4">
                        <div class="contenido">
                            <label class="subtitulo" for="cantidad">Cantidades:</label>
                            <x-input-error :messages="$errors->get('cantidades')" class="mt-2" />
                            <input class="datos" type="number" id="cantidades" name="cantidades"
                                :value="old('cantidades')" autofocus autocomplete="cantidades">
                            <div class="tooltip">?
                                <span class="tooltiptext">Cantidad del trabajo a realizar</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="contenido">
                            <label class="subtitulo" for="iva">Factura:</label>
                            <x-input-error :messages="$errors->get('iva')" class="mt-2" />
                            <input class="datos" type="decimal" id="iva" name="iva" :value="old('iva')"
                                autofocus autocomplete="iva">
                            <div class="tooltip">?
                                <span class="tooltiptext">Porcentaje a pagar de la factura (16)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">

                    <x-input-label for="descripcion" :value="__('Descripcion')" style="color: white;font-size:1.5rem" />
                    <div class="tooltip">?
                        <span class="tooltiptext">Ingresarla descripcion sobre el trabajo que se va realizar</span>
                    </div>
                    <br>
                    <textarea placeholder="ingresar la descripción del trabajo a realizar" name="descripcion" id="descripcion"
                        cols="20" rows="10" style="padding:9px;"></textarea>
                </div>
                <div class="botns">

                    <button>
                        <p>Registrar</p>
                    </button>


                    <div class="forget">
                        <a href="{{ route('trabIndex') }}">Regresar</a>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
</x-layouts.nuevos>
