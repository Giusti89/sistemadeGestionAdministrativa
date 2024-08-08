<div>
    <link rel="stylesheet" href="./css/dashbord.css">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="botones">
                        <div>
                            <x-layouts.btnconfirmar contenido="Crear Usuario" enlace="register">
                            </x-layouts.btnconfirmar>
                        </div>
                        <div>
                            <label for="filtro">Filtrar por nombre: </label>
                            <input type="text" wire:model.live="search">
                        </div>
                        <div>
                            <label for="filtro">Paginas: </label>
                            <input type="number" wire:model.live="paginate">
                        </div>

                    </div>

                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Numero de clientes</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Inicio Suscripción</th>
                                    <th>Final de la suscripcion</th>
                                    <th>dias restantes</th>
                                    <th>Modificación</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $usuario)
                                    <tr>

                                        <td class="filas-tabla">
                                            {{ $usuario->name }}
                                        </td>

                                        <td class="filas-tabla">
                                            {{ $usuario->clientes_count }}
                                        </td>

                                        <td class="filas-tabla">
                                            {{ $usuario->lastname }}
                                        </td>
                                        <td class="filas-tabla">
                                            {{ $usuario->email }}
                                        </td>
                                        <td class="filas-tabla">
                                            {{ \Carbon\Carbon::parse($usuario->inicio)->format('d/m/Y') }}
                                        </td>
                                        <td class="filas-tabla">
                                            {{ \Carbon\Carbon::parse($usuario->final)->format('d/m/Y') }}
                                        </td>
                                        <td class="filas-tabla">
                                            {{ $usuario->mensaje }}
                                        </td>
                                        <td class="filas-tabla">
                                            @php
                                                $encryptedId = Crypt::encrypt($usuario->id);
                                            @endphp

                                            @if (now()->diffInDays($usuario->final, false) <= 0)
                                                <x-layouts.btnmodif rutaEnvio="adminRenovar" dato="{{ $encryptedId }}"
                                                    nombre="Renovar" color="red">
                                                </x-layouts.btnmodif>
                                            @else
                                                <div>
                                                    <x-layouts.btnmodif rutaEnvio="editusu" dato="{{ $encryptedId}}"
                                                        nombre="Ver Datos">
                                                    </x-layouts.btnmodif>
                                                </div>
                                            @endif

                                        </td>
                                        <td class="filas-tabla">
                                            <div>
                                                <form class="eli" action="{{ route('eliadmin', $usuario->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-layouts.btnelim contenido="Eliminar">
                                                    </x-layouts.btnelim>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $('.eli').submit(function(e) {
                e.preventDefault()

                Swal.fire({
                    title: "¿Estas seguro de eliminar este cliente?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminar"
                }).then((result) => {
                    if (result.value) {
                        this.submit();
                    }
                });
            });
        </script>
    @endsection
</div>
