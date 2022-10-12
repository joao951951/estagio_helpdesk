
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16"> 
                                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                            </svg>                            
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

                            <!-- @php
                                if (request()->has('client_id')) {
                                    $client = \App\Models\Client::find(request()->get('client_id'));
                                }
                            @endphp -->

                            <div class="relative mb-3">
                                <select
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="priority"
                                    name="priority_id"
                                >
                                    <option value="0" selected disabled >Selecione uma Prioridade</option>

                                    @foreach ($priorities as $priority)
                                        <option value="{{ $priority->id }}">{{ $priority->desc_priority }}</option>
                                    @endforeach
                                </select>
                            </div>
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

                                    <option value="">Não atribuir técnico</option>

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
            }
        </script>
    </x-slot>
</x-app-layout>
