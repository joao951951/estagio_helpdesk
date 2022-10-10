<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Histórico') }}
        </h2>
    </x-slot>

    <div class="py-3">
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
                        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Chamado {{ $ticket->title }}</h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 py-6">
                                    <dt class="text-md font-medium text-gray-900">Cliente {{ $client->name }}</dt>
                                    <dd class="mt-1 text-md text-gray-900 sm:col-span-2 sm:mt-0 ">Responsável {{ $client->responsible }}, contato {{ $client->phone }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 py-6">
                                    <dt class="text-md font-medium text-gray-900">Tecnico Responsável pelo atendimento</dt>
                                    <dd class="mt-1 text-md text-gray-900 sm:col-span-2 sm:mt-0 ">{{ $employee->name }}, contato: {{ $employee->phone }}</dd>
                                    <dd class="mt-1 text-md text-gray-900 sm:col-span-2 sm:mt-0 ">Status do chamado, {{ \App\Models\Status::find($ticket->status)->desc_status }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 py-6">
                                    <dt class="text-md font-medium text-gray-900">Defeitos Reclamados</dt>
                                    <dd class="mt-1 text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $ticket->claimed_defect }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 py-6">
                                    <dt class="text-md font-medium text-gray-900">Defeitos Constatados</dt>
                                    <dd class="mt-1 text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $ticket->found_defect }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 py-6">
                                <dt class="text-md font-medium text-gray-900">Serviço Realizado</dt>
                                    <dd class="mt-1 text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $ticket->service_performed }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 py-6">
                                    <dt class="text-md font-medium text-gray-900">Peças Trocadas</dt>
                                    <dd class="mt-1 text-md text-gray-900 sm:col-span-2 sm:mt-0">{{ $ticket->swap_parts }}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 grid grid-cols-2 gap-2 sm:px-6">
                                    <dt class="text-md font-medium text-gray-900">Histórico</dt>
                                    <dd class="mt-1 text-md text-gray-900 sm:col-span-2 sm:mt-0">
                                        <div style="padding-left:60%" class="ml-4 flex-shrink-0">
                                            <!-- <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Ver Mais</a> -->
                                            <button id="btnVerMais" type="button" class="font-medium text-indigo-600 btn btn-outline btn-default" data-toggle="tooltip" data-original-title="Ver mais" data-container="body">
                                                <i class="icon wb-search" aria-hidden="true"></i>
                                                <span class="hidden-xs">Ver detalhes</span>
                                            </button>
                                        </div>
                                    </dd>
                                    </div>
                                    @if (count($history_ticket) > 0)
                                        <dd class="mt-1 text-md text-gray-900 sm:col-span-2 sm:mt-0">
                                        <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                        @foreach ($history_ticket as $key => $ticket)
                                            <li class="flex items-center justify-between py-6 pl-3 pr-4 text-md">
                                            <div class="flex w-0 flex-1 items-center">
                                                <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <img style="width: 1.5em; height:1.5em " src="{{ asset('images/img-history.png') }}" alt="img-history">
                                                </svg>
                                                <span class="ml-2 w-0 flex-1 truncate">{{ $ticket->descri }}</span>
                                            </div>
                                            </li>
                                            <div class="flex w-0 flex-1 items-center">
                                                <div class=" grid grid-cols-1 divOculta h-56  gap-4 content-center">
                                                    <div class="overflow-x-auto relative">
                                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                                <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                                                                    <tr>
                                                                        <div>
                                                                            <th scope="col" class=" px-6">
                                                                                Nome do técnico
                                                                            </th>
                                                                        </div>
                                                                        <div>
                                                                            <th scope="col" class="px-6">
                                                                                Defeitos Reclamados
                                                                            </th>
                                                                        </div>
                                                                        <div>
                                                                            <th scope="col" class="px-6">
                                                                                Defeitos Constatados
                                                                            </th>
                                                                        </div>
                                                                        <div>
                                                                            <th scope="col" class="px-6">
                                                                                Serviço Realizado
                                                                            </th>
                                                                        </div>
                                                                        <div>
                                                                            <th scope="col" class="px-6">
                                                                                Peças Trocadas
                                                                            </th>
                                                                        </div>
                                                                        <div>
                                                                            <th scope="col" class="px-6">
                                                                                Data e Hora Alteração
                                                                            </th>
                                                                        </div>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="bg-white dark:bg-gray-800">
                                                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                            {{ $employee->name }}
                                                                        </th>
                                                                        <td class="py-4 px-6">
                                                                            {{ $ticket->claimed_defect_new }}
                                                                        </td>
                                                                        <td class="py-4 px-6">
                                                                            {{ $ticket->found_defect_new }}
                                                                        </td>
                                                                        <td class="py-4 px-6">
                                                                            {{ $ticket->service_performed_new }}
                                                                        </td>
                                                                        <td class="py-4 px-6">
                                                                            {{ $ticket->service_performed_new }}
                                                                        </td>
                                                                        <td class="py-4 px-6">
                                                                            {{ $ticket->created_at->format('d-m-Y H:i:s') }}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <br>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </ul>
                                        <br>
                                        </dd>
                                    @else
                                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mt-2" role="alert">
                                            <span class="block sm:inline">Nenhuma alteração registrada</span>
                                        </div>
                                        <br>
                                    @endif
                                </div>
                                </dl>
                            </div>
                        </div>
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

            $(document).ready(function() {
                $(".divOculta").hide();
                $("#btnVerMais").on("click", function() {
                $(".divOculta").toggle();
            })
            
            })
        </script>
    </x-slot>
</x-app-layout>
