<x-layouts.nuevos titulo="Registrar Gasto" css="../css/gastosupdate.css">

    <section>
        <form method="POST" action="{{ route('updateGasto', $gasto->id) }}">
            @csrf
            @method('PUT')

            <h1>Modificar datos del Gasto</h1>

            <input type="hidden" name="id" value="{{ $gasto->id }}">

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text" required id="concepto" name="concepto" value="{{$gasto->concepto}}" autofocus
                    autocomplete="concepto">
                <label for="">Concepto</label>
                <x-input-error :messages="$errors->get('concepto')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="descripcion" :value="__('Descripción')" style="color: white;font-size:1.5rem" /> <br>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10" style="padding:9px;">{{$gasto->descripcion}}</textarea>
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="number" required id="costo" name="costo" value="{{$gasto->costo}}" autofocus
                    autocomplete="costo" >
                <label for="">Costo</label>
                <x-input-error :messages="$errors->get('costo')" class="mt-2" />
            </div>

            <div class="datos">
                <label for="fecha">Fecha: </label>
                <input type="date" value="{{ $gasto->fecha }}" disabled>
            </div>



            <button>
                <p>Registrar</p>
            </button>

            <div class="forget">
                <a href="{{ route('gastoIndex') }}">Regresar</a>
            </div>
        </form>
    </section>

</x-layouts.nuevos>