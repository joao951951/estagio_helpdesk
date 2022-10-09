<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Técnicos') }}
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
                    <form action="{{ route('funcionarios.create') }}">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Adicionar Técnico
                        </button>
                    </form>

                    @if (count($employees) > 0)
                        <div class='overflow-x-auto relative shadow-md sm:rounded-lg py-2'>
                            <table class='w-full text-sm text-left text-gray-500 dark:text-gray-400'>
                                <thead class="bg-gray-500 ">
                                    <tr class="text-white text-left">
                                        {{-- <form action="" id="order-form">
                                            <input type="hidden" id="order-column" name="orderColumn">
                                            <input type="hidden" id="order" name="order">
                                        </form> --}}

                                        <th class="font-semibold text-sm uppercase px-6 py-4">Nome</th>
                                        <th class="font-semibold text-sm uppercase px-6 py-4">CPF</th>
                                        <th class="font-semibold text-sm uppercase px-6 py-4">Contato</th>
                                        <th class="font-semibold text-sm uppercase px-6 py-4">Ação</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($employees as $key => $employee)
                                        <tr>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center space-x-3">
                                                    <div>
                                                        <p>{{ $employee->name }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4">
                                                <p class="">{{ $employee->cpf }}</p>
                                            </td>

                                            <td class="px-6 py-4">
                                                <p class="">{{ $employee->phone }}</p>
                                            </td>

                                            <td class="px-6 py-4" onclick="edit({{ $key }})">
                                                <span class="text-purple-800 hover:underline hover:cursor-pointer">Editar<span>

                                                <form action="{{ route('funcionarios.edit', [$employee->id]) }}" id="form-{{ $key }}"></form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- {{ $employee->appends(request()->input())->links() }} --}}
                            </table>
                        </div>
                    @else
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mt-2" role="alert">
                            <span class="block sm:inline">Não tem técnicos cadastrados</span>
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
