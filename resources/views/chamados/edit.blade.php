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

                    <form class="grid grid-cols-6 gap-4" action="{{ route('chamados.update', $ticket->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="client_id" value="{{ $ticket->client_id }}">

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="client">
                                Cliente
                            </label>

                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="client"
                                type="text"
                                name="client"
                                readonly
                                required
                                value="{{ \App\Models\Client::find($ticket->client_id)->name }}"
                            >
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
                                value="{{ $ticket->title }}"
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
                            >{{ $ticket->claimed_defect }}</textarea>
                        </div>

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="found_defect">
                                Defeitos Constatados
                            </label>

                            <textarea
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                name="found_defect"
                                id="found_defect"
                                cols="30"
                                rows="3"
                                placeholder="Digite os defeitos constatados..."
                            >{{ $ticket->found_defect ?? '' }}</textarea>
                        </div>

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="service_performed">
                                Serviços Executados
                            </label>

                            <textarea
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                name="service_performed"
                                id="service_performed"
                                cols="30"
                                rows="3"
                                placeholder="Digite os serviços executados..."
                            >{{ $ticket->service_performed ?? '' }}</textarea>
                        </div>

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="swap_parts">
                                Peças Trocadas
                            </label>

                            <textarea
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                name="swap_parts"
                                id="swap_parts"
                                cols="30"
                                rows="3"
                                placeholder="Digite as peças trocadas..."
                            >{{ $ticket->swap_parts ?? '' }}</textarea>
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
                                value="{{ $ticket->priority }}"
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
                                    required
                                >
                                    <option value="" selected disabled>Selecione uma Opção</option>

                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" @if ($ticket->employee_id == $employee->id) selected @endif>{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status">
                                Status
                            </label>

                            <div class="relative mb-3">
                                <select
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="status"
                                    name="status"
                                    required
                                >
                                    <option value="" selected disabled>Selecione uma Opção</option>
                                    <option value="aberto" @if ($ticket->status == 'aberto') selected @endif>Aberto</option>
                                    <option value="em-andamento" @if ($ticket->status == 'em-andamento') selected @endif>Em Andamento</option>
                                    <option value="fechado" @if ($ticket->status == 'fechado') selected @endif>Fechado</option>
                                </select>
                            </div>
                        </div>

                        @if ($ticket->status == 'fechado')
                            <div class="col-span-6">
                                <div class="grid grid-cols-5">
                                    <button
                                        type="button"
                                        class="bg-gray-500 text-white font-bold py-2 px-4 rounded mb-3 col-span-5 lg:col-span-1 opacity-50 cursor-default hover:bg-gray-700"
                                        disabled
                                    >
                                        Ticket Fechado
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="col-span-6">
                                <div class="grid grid-cols-5">
                                    <button
                                        type="submit"
                                        class="bg-blue-500 text-white font-bold py-2 px-4 rounded mb-3 col-span-5 lg:col-span-1 disabled:opacity-50 hover:bg-blue-700"
                                    >
                                        Salvar
                                    </button>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
        </script>
    </x-slot>
</x-app-layout>