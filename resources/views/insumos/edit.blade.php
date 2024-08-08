<x-layouts.nuevos titulo="Nuevos Clientes" css="../css/editarTrabajo.css">

    <div class="contenedor">
        <form method="POST" action="{{ route('updateInsumo', $coti->id) }}">
            @csrf
            @method('PUT')
            <h1>Modificar datos</h1>

            <section class="seccion1">
                <div class="datos">
                    <label for="">Trabajo/Servicio</label> <br> <br>
                    <input type="text" id="nombre" name="nombre" value="{{ $coti->nombre }}" autofocus
                        autocomplete="nombre">
                    <x-input-error :messages="$errors->get('trabajo')" class="mt-2" />
                </div>

                <div class="datos">
                    <label for="">Cantidad</label> <br> <br>
                    <input type="number" id="cantidad" name="cantidad" value="{{ $coti->cantidad }}" autofocus
                        autocomplete="cantidad" step="0.01">
                    <x-input-error :messages="$errors->get('cantidad')" class="mt-2" />
                </div>

                <div class="datos">
                    <label for="">Descripcion</label> <br> <br>
                    <textarea style="padding: 9px" name="detalle" id="detalle" cols="30" rows="10">{{ $coti->detalle }}</textarea>
                </div>

                <div class="datos">

                    <label for="">Costo</label> <br> <br>
                    <input type="number" id="costo" name="costo" value="{{ $coti->costo }}" autofocus
                        autocomplete="costo">

                    <x-input-error :messages="$errors->get('costo')" class="mt-2" />
                </div>

                <div class="envio">
                    <button>
                        <p>Modificar</p>
                    </button>
                </div>

                <div class="forget">
                    <a href="{{ route('insumoIndex', Crypt::encrypt($coti->trabajo_id)) }}">Regresar</a>
                </div>

            </section>
        </form>
    </div>



</x-layouts.nuevos>
