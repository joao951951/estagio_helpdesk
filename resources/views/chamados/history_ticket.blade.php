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
                        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Chamado {{ $ticket->title }}</h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 py-6">
                                    <dt class="text-md font-medium text-gray-900">Cliente {{ $client->name }}</dt>
                                    <dd class="mt-1 text-md text-gray-900 sm:col-span-2 sm:mt-0 ">Responsável {{ $client->responsible }}</dd>
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
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-md font-medium text-gray-900">Histórico</dt>
                                    @if (count($history_ticket) > 0)
                                        <dd class="mt-1 text-md text-gray-900 sm:col-span-2 sm:mt-0">
                                        <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                        @foreach ($history_ticket as $key => $ticket)
                                            <li class="flex items-center justify-between py-3 pl-3 pr-4 text-md">
                                            <div class="flex w-0 flex-1 items-center">
                                                <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-2 w-0 flex-1 truncate">{{ $ticket->descri }}</span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                                            </div>
                                            </li>
                                            <li class="flex items-center justify-between py-3 pl-3 pr-4 text-md">
                                            <div class="flex w-0 flex-1 items-center">
                                                <!-- Heroicon name: mini/paper-clip -->
                                                <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-2 w-0 flex-1 truncate">coverletter_back_end_developer.pdf</span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                                            </div>
                                            </li>
                                        @endforeach
                                        </ul>
                                        </dd>
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
        </script>
    </x-slot>
</x-app-layout>
