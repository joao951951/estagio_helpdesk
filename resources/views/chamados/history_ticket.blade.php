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
                    <div class="flex grid-cols-2 gap-2 justify-end">
                            @if($type_user == 0)
                                <div>
                                    <form class="form-get" action="{{ route('chamados.assumir', [$query] ) }}" method="PUT">
                                        <button type="button" class="inline-block px-6 py-2.5 bg-blue-400 rounded shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out modal-open">Assumir Chamado</button>
                                    </form>
                                </div>
                            @endif
                            <div>
                                <form >
                                    <a href="{{ route('chamados.edit', [$ticket]) }}">
                                        <button type="button" class="inline-block px-6 py-2.5 bg-blue-400 rounded shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out">Editar Chamado</button>
                                    </a>
                                </form>
                            </div>
                    </div>
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
        <!--Modal-->
        <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Assumir</p>

                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <p>Dejesa registrar o atendimento em seu nome ?</p>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button class="modal-remove px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Sim</button>
                    <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Cancelar</button>
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

        var openmodal = document.querySelectorAll('.modal-open')

        for (var i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function(event){
                event.preventDefault()
                toggleModal()
            })
        }

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
        }

        const remove = document.querySelector('.modal-remove');

        remove.addEventListener('click', () => {
            const formGet = document.querySelector('.form-get');
            formGet.submit();
        });

        document.onkeydown = function(evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }

            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
            }
        };


        function toggleModal () {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
        }
        </script>
    </x-slot>
</x-app-layout>
