<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Editar Cliente: $client->name") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('clientes.index') }}">
                        <button class="focus:outline-white hover:bg-blue-500 hover:text-white text-black font-bold py-1 px-1 rounded mb-3 border border-blue">
                            Voltar
                        </button>
                    </form>

                    <form class="grid grid-cols-6 gap-4" action="{{ route('clientes.update', [$client->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Nome
                            </label>

                            <input
                                {{-- border border-red-500 --}}
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="name"
                                type="text"
                                placeholder="Digite o nome..."
                                name="name"
                                required
                                value="{{ $client->name }}"
                            >
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cnpj">
                                CNPJ
                            </label>

                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="cnpj"
                                type="text"
                                placeholder="Digite o CNPJ..."
                                name="cnpj"
                                required
                                value="{{ $client->cnpj }}"
                            >
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="insc">
                                Inscrição Estadual
                            </label>

                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="insc"
                                type="text"
                                placeholder="Digite a inscrição estadual..."
                                name="insc"
                                required
                                value="{{ $client->insc }}"
                            >
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                                E-mail
                            </label>

                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="email"
                                type="email"
                                placeholder="Digite o e-mail..."
                                name="email"
                                required
                                value="{{ $client->email }}"
                            >
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                Telefone
                            </label>

                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="phone"
                                type="text"
                                name="phone"
                                value="{{ $client->phone }}"
                                required
                            >
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
                                Endereço
                            </label>

                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="address"
                                type="text"
                                name="address"
                                value="{{ $client->address }}"
                                required
                            >
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                                Cidade
                            </label>

                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="city"
                                type="text"
                                name="city"
                                value="{{ $client->city }}"
                                required
                            >
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contrato">
                                Contrato
                            </label>

                            <div class="relative">
                                <select
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="contrato"
                                    name="contract"
                                    required
                                >
                                    <option value="" selected disabled>Selecione uma Opção</option>
                                    <option value="contrato1" @if ($client->contract === 'contrato1') selected @endif>Contrato 1 - Cliente com contrato mensal</option>
                                    <option value="contrato2" @if ($client->contract === 'contrato2') selected @endif>Contrato 2 - Cliente sem contrato, mas sempre atendemos</option>
                                    <option value="contrato3" @if ($client->contract === 'contrato3') selected @endif>Contrato 3 - Cliente novo</option>
                                    <option value="contrato4" @if ($client->contract === 'contrato4') selected @endif>Contrato 4 - Cliente avulso, algumas vezes atendemos</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-span-6">
                            <div class="grid grid-cols-5">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-3 col-span-5 lg:col-start-1 lg:col-end-2">
                                    Salvar
                                </button>

                                <button
                                    type="button"
                                    class="border border-blue text-black font-bold py-2 px-4 rounded mb-3 modal-open col-span-5 focus:outline-white hover:bg-red-300 lg:col-end-6 lg:col-start-6"
                                >
                                    Excluir
                                </button>
                            </div>
                        </div>
                    </form>

                    <form action="{{ route('clientes.destroy', [$client->id]) }}" method="POST" class="form-remove">
                        @csrf
                        @method('DELETE')
                    </form>
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
                    <p class="text-2xl font-bold">Excluir</p>

                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <p>Confirmar a exclusão?</p>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button class="modal-remove px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Excluir</button>
                    <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
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
            const formRemove = document.querySelector('.form-remove');
            formRemove.submit();
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
</x-app-layout>
