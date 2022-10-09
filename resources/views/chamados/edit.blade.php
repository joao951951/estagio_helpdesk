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

                            <!-- @php
                                if (request()->has('client_id')) {
                                    $client = \App\Models\Client::find(request()->get('client_id'));
                                }
                            @endphp -->
                        
                            <!-- <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="priority"
                                type="text"
                                name="priority"
                                readonly
                                required
                                value="{{ \App\Models\Priority::find($ticket->priority_id)->desc_priority }}"
                            > -->

                            <div class="relative mb-3">
                                <select
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="priority"
                                    name="priority_id"
                                    required
                                >
                                    <option value="" selected disabled>Selecione uma Opção</option>

                                    @foreach ($priorities as $priority)
                                        <option value="{{ $priority->id }}" @if ($ticket->priority_id == $priority->id) selected @endif>{{ $priority->desc_priority }}</option>
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
                                    <!-- <option value="" selected disabled>Selecione uma Opção</option>
                                    <option value=1 @if ($ticket->status == '1') selected @endif>Aberto</option>
                                    <option value=2 @if ($ticket->status == '2') selected @endif>Em Andamento</option>
                                    <option value=3 @if ($ticket->status == '3') selected @endif>Visita Tecnica</option>
                                    <option value=4 @if ($ticket->status == '4') selected @endif>Fechado</option> -->
                                    
                                    @foreach ($status as $state)
                                        <option value="{{ $state->id }}" @if ($ticket->status == $state->id) selected @endif>{{ $state->desc_status }}</option>
                                    @endforeach
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
