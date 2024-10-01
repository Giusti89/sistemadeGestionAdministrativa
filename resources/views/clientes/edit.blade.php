<x-layouts.nuevos titulo="Modificar Clientes" css="../css/modusu.css">
    <section> 

        <form method="POST" action="{{ route('clienteUpdate', $clie->id) }}">

            @csrf
            @method('PUT')

            <h1>Editar los datos del cliente</h1>

            <input type="hidden" name="usuario_id" value="{{ Auth::id() }}">
            
            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text" required id="nombre" name="nombre" value="{{$clie->nombre}}" required autofocus autocomplete="nombre">
                <label for="">Nombre</label>
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text" required id="apellido" name="apellido" value="{{$clie->apellido}}" required autofocus autocomplete="apellido">
                <label for="">Apellido</label>
                <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="number"  id="contacto" name="contacto" value="{{$clie->contacto}}" autocomplete="contacto">
                <label for="">Nit</label>
                <x-input-error :messages="$errors->get('contacto')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="number"  id="nit" name="nit" value="{{$clie->nit}}" autocomplete="nit">
                <label for="">Nit</label>
                <x-input-error :messages="$errors->get('nit')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" required id="email" name="email" value="{{$clie->email}}" required autofocus autocomplete="username">
                <label for="">Email</label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <button> <p>Modificar</p> </button>

            <div class="forget">                
                <a href="{{ route('clientIndex') }}">Regresar</a>
            </div>                 
        </form>
    </section>


</x-layouts.nuevos>