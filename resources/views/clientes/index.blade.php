<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Clientes') }}
        </h2>
    </x-slot>

    <div class="py-3">
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3" role="alert">
                <span class="block sm:inline">{{ session()->get('success') }}</span>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-3" role="alert">
                <span class="block sm:inline">{{ session()->get('error') }}</span>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('clientes.create') }}">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Adicionar Cliente
                        </button>
                    </form>

                    @if (count($clients) > 0)
                        <div class='overflow-x-auto w-full py-2'>
                            <table class='mx-auto max-w-7xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                <thead class="bg-gray-500">
                                    <tr class="text-white text-left">
                                        {{-- <form action="" id="order-form">
                                            <input type="hidden" id="order-column" name="orderColumn">
                                            <input type="hidden" id="order" name="order">
                                        </form> --}}

                                        <th class="font-semibold text-sm uppercase px-6 py-4">Nome</th>
                                        <th class="font-semibold text-sm uppercase px-6 py-4">E-mail</th>
                                        <th class="font-semibold text-sm uppercase px-6 py-4">Tipo Contrato</th>
                                        <th class="font-semibold text-sm uppercase px-6 py-4">Ação</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($clients as $key => $client)
                                        <tr>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center space-x-3">
                                                    <div>
                                                        <p>{{ $client->name }}</p>
                                                        <p class="text-gray-500 text-sm font-semibold tracking-wide">{{ $client->cnpj }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4">
                                                <p class="">{{ $client->email }}</p>
                                            </td>

                                            <td class="px-6 py-4">{{ $client->contract }}</td>

                                            <td class="px-6 py-4" onclick="edit({{ $key }})">
                                                <span class="text-purple-800 hover:underline hover:cursor-pointer">Editar<span>

                                                <form action="{{ route('clientes.edit', [$client->id]) }}" id="form-{{ $key }}"></form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- {{ $clients->appends(request()->input())->links() }} --}}
                            </table>
                        </div>
                    @else
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mt-2" role="alert">
                            <span class="block sm:inline">Não tem clientes cadastrados</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            function edit(key) {
                const form = document.getElementById(`form-${key}`);
                form.submit();
            }
        </script>
    </x-slot>
</x-app-layout>
