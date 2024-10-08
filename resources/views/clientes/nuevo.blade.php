<x-layouts.nuevos titulo="Nuevos Clientes" css="./css/clientenuevo.css">
    <section>        
        <form method="POST" action="{{ route('crearCliente') }}">
            @csrf
            <h1>Nuevo Cliente</h1>

           
            
            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text"  id="nombre" name="nombre" :value="old('nombre')"  autofocus autocomplete="nombre">
                <label for="">Nombre</label>
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>


            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text"  id="apellido" name="apellido" :value="old('apellido')" autofocus autocomplete="apellido">
                <label for="">Apellido</label>
                <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="number" required id="contacto" name="contacto" :value="old('contacto')" required autofocus autocomplete="contacto" maxlength="12">
                <label for="">Celular</label>
                <x-input-error :messages="$errors->get('contacto')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" required id="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                <label for="">Email</label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="number"  id="nit" name="nit" :value="old('nit')" autofocus
                    autocomplete="nit">
                <label for="">Nit</label>
                <x-input-error :messages="$errors->get('nit')" class="mt-2" />
            </div>       
    
            <button> <p>Registrar</p> </button>

            <div class="forget">                
                <a href="{{ route('clientIndex') }}">Regresar</a>
            </div>                 
        </form>
    </section>
</x-layouts.nuevos>