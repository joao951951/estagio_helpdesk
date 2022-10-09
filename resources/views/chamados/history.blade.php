<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Chamados') }}
        </h2>
    </x-slot>

    <div class="py-3 flex h-screen justify-center items-center">


        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 lg:col-span-3 py-2 lg:py-0">
                <div class="max-w-1xl sm:px-6 lg:px-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                        <div class="grid grid-cols-2">
                            <form action="" name="initialDateForm" class="col-span-2">
                                <div class="col-span-2">
                                    <label for="initial-date">Data Início</label>
                                </div>

                                <div class="">
                                    <input
                                        type="date"
                                        id="initial-date"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        name="initialDate"
                                        value="{{ $initialDate }}"
                                        onchange="initialDateForm.submit();"
                                        max="{{ $finalDate }}"
                                    >
                                </div>

                                <input type="hidden" name="finalDate" value="{{ $finalDate }}">
                            </form>

                            <form action="" name="finalDateForm" class="col-span-2 mt-2">
                                <input type="hidden" name="initialDate" value="{{ $initialDate }}">

                                <div>
                                    <label for="final-date">Data Fim</label>
                                </div>

                                <div class="col-span-2">
                                    <input
                                        type="date"
                                        id="final-date"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        name="finalDate"
                                        value="{{ $finalDate }}"
                                        onchange="finalDateForm.submit();"
                                        min="{{ $initialDate }}"
                                    >
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-9">
                <div class="max-w-7xl mr-2">
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
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <form action="{{ route('chamados.create') }}">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Adicionar Chamado
                                </button>
                            </form>

                            <form action="" id="order-form">
                                <input type="hidden" id="order-column" name="orderColumn">
                                <input type="hidden" id="order" name="order">
                            </form>

                            @if (count($tickets) > 0)
                                <div class='overflow-x-auto relative shadow-md sm:rounded-lg py-2'>
                                    <table class='w-full text-sm text-left text-gray-500 dark:text-gray-400'>
                                        <thead class="bg-gray-500">
                                            <tr class="text-white text-left">
                                                <form action="" id="order-form">
                                                    <input type="hidden" id="order-column" name="orderColumn">
                                                    <input type="hidden" id="order" name="order">
                                                </form>

                                                <th class="font-semibold text-sm uppercase px-6 py-4">Cliente</th>
                                                <th class="font-semibold text-sm uppercase px-6 py-4">Título</th>
                                                <!-- <th class="font-semibold text-sm uppercase px-6 py-4 text-center hover:bg-gray-800 hover:cursor-pointer"  onclick="sendOrder('priority');">
                                                    Prioridade @if ($orderColumn == 'priority') @if ($order == 'ASC') &#129045; @else &#129047; @endif @endif
                                                </th> -->
                                                <th class="font-semibold text-sm uppercase px-6 py-4">
                                                    Prioridade
                                                </th>
                                                <th class="font-semibold text-sm uppercase px-6 py-4 text-center hover:bg-gray-800 hover:cursor-pointer"  onclick="sendOrder('status');">
                                                    Status @if ($orderColumn == 'status') @if ($order == 'ASC') &#129045; @else &#129047; @endif @endif
                                                </th>
                                                <th class="font-semibold text-sm uppercase px-6 py-4">Data Abertura</th>
                                                <th class="font-semibold text-sm uppercase px-6 py-4">Técnico</th>
                                                <th class="font-semibold text-sm uppercase px-6 py-4">Ação</th>
                                            </tr>
                                        </thead>

                                        <tbody class="divide-y divide-gray-200">
                                            @foreach ($tickets as $key => $ticket)
                                                <tr>
                                                    <td class="px-6 py-4">
                                                        <div class="flex items-center space-x-3">
                                                            <div>
                                                                <p>{{ clientName($ticket->client_id) }}</p>
                                                                <p class="text-gray-500 text-sm font-semibold tracking-wide">{{ clientEmail($ticket->client_id) }}</p>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="px-6 py-4">
                                                        <p class="">{{ $ticket->title }}</p>
                                                    </td>

                                                    @if($ticket->priority_id == 1)
                                                        <td class="px-6 py-4 text-center">Baixa</td>
                                                    @elseif($ticket->priority_id == 2)
                                                        <td class="px-6 py-4 text-center">Urgente</td>
                                                    @else
                                                        <td class="px-6 py-4 text-center">Emergente</td>
                                                    @endif

                                                    <td class="px-6 py-4 text-center">
                                                        <span class="text-white text-sm w-1/3 pb-1 font-semibold px-2 rounded-full
                                                            @if ($ticket->status == '1')
                                                                bg-red-600
                                                            @elseif ($ticket->status == '2')
                                                                bg-yellow-600
                                                            @elseif ($ticket->status == '3')
                                                                bg-yellow-600
                                                            @else
                                                                bg-green-600
                                                            @endif
                                                            "
                                                            >
                                                            {{ \App\Models\Status::find($ticket->status)->desc_status }}
                                                        </span>
                                                    </td>

                                                    <td class="px-6 py-4 text-center">{{ $ticket->created_at->format('d-m-Y H:i:s') }}</td>

                                                    <td>
                                                        {{ $ticket->employee_id ? employeeName($ticket->employee_id) : 'Nenhum técnico' }}
                                                    </td>

                                                    <td class="px-6 py-4 text-center" onclick="edit({{ $key }})">
                                                        <span class="text-purple-800 hover:underline hover:cursor-pointer">Editar<span>

                                                        <form action="{{ route('chamados.edit', [$ticket->id]) }}" id="form-{{ $key }}"></form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        {{ $tickets->appends(request()->input())->links() }}
                                    </table>
                                </div>
                            @else
                                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mt-2" role="alert">
                                    <span class="block sm:inline">Nenhum chamado</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            let orderColumn = "{{ $orderColumn }}";
            let order = "{{ $order }}";
        </script>

        <script>
            /* function show(message, key) {
                const messageBox = $(`#message-${key}`);
                messageBox.text(message);
                $(`#message-box-${key}`).attr('hidden', false);
            }
            function hide(key) {
                $(`#message-box-${key}`).attr('hidden', true);
            } */
            function edit(key) {
                const form = document.getElementById(`form-${key}`);
                form.submit();
            }
            function sendOrder(coluna) {
                if (coluna == orderColumn) {
                    if (order == 'ASC') {
                        order = 'DESC';
                    } else {
                        order = 'ASC'
                    }
                }
                document.getElementById('order-column').value = coluna;
                document.getElementById('order').value = order;
                // Enviar formulário
                document.getElementById('order-form').submit();
            }
        </script>
    </x-slot>
</x-app-layout>