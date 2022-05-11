
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Chamado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('chamados.index') }}">
                        <button class="focus:outline-white hover:bg-blue-500 hover:text-white text-black font-bold py-1 px-1 rounded mb-3 border border-blue">
                            Voltar
                        </button>
                    </form>

                    <form class="grid grid-cols-6 gap-4" action="{{ route('chamados.store') }}" method="POST">
                        @csrf

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="client">
                                Cliente
                            </label>

                            <div class="relative mb-3">
                                <select
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="client"
                                    name="client_id"
                                    required
                                    autofocus
                                    onchange="getClientInformation()"
                                >
                                    <option value="" selected disabled>Selecione uma Opção</option>

                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" @if (request()->has('client_id') && request()->get('client_id') == $client->id) selected @endif>{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                                Título
                            </label>

                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="title"
                                type="text"
                                placeholder="Digite o título..."
                                name="title"
                                required
                            >
                        </div>

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="claimed_defect">
                                Defeitos Reclamados
                            </label>

                            <textarea
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                name="claimed_defect"
                                id="claimed_defect"
                                cols="30"
                                rows="3"
                                placeholder="Digite o defeitos reclamados..."
                                required
                            ></textarea>
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="priority">
                                Prioridade
                            </label>

                            @php
                                if (request()->has('client_id')) {
                                    $client = \App\Models\Client::find(request()->get('client_id'));
                                }
                            @endphp

                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="priority"
                                type="text"
                                name="priority"
                                readonly
                                required
                                value="Selecione um cliente para classificar uma prioridade"
                            >
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="employee">
                                Técnico
                            </label>

                            <div class="relative mb-3">
                                <select
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="employee"
                                    name="employee_id"
                                >
                                    <option value="" selected disabled>Selecione uma Opção</option>

                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-span-6">
                            <div class="grid grid-cols-5">
                                <button
                                    type="submit"
                                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded mb-3 col-span-5 lg:col-span-1 disabled:opacity-50 hover:bg-blue-700"
                                    id="add-button"
                                >
                                    Adicionar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            function getClientInformation() {
                const idCliente = $('#client').val();

                $.ajax({
                    url: "/api/clientes",
                    type: "get",
                    data: {
                        idCliente: idCliente
                    },
                    success: function(res) {
                        const client = res.client;
                        const priority = $('#priority');

                        if (client.contract == 'contrato1') {
                            priority.val('muito-alto');
                        } else if (client.contract == 'contrato2') {
                            priority.val('alto');
                        } else if (client.contract == 'contrato3') {
                            priority.val('medio');
                        } else if (client.contract == 'contrato4') {
                            priority.val('baixo');
                        }
                    }
                });
            }
        </script>
    </x-slot>
</x-app-layout>