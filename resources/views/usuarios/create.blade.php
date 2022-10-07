<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Adminstrador') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div
            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-3"
            id="message-container"
            role="alert"
            hidden
        >
            <span class="block sm:inline" id="message"></span>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('administradores.index') }}">
                        <button class="focus:outline-white hover:bg-blue-500 hover:text-white text-black font-bold py-1 px-1 rounded mb-3 border border-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16"> 
                                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                            </svg>                            
                        </button>
                    </form>

                    <form class="grid grid-cols-6 gap-4" action="{{ route('administradores.store') }}" method="POST" id="create-form">
                        @csrf

                        <input type="hidden" name="admin" value="1">

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Nome
                            </label>

                            <input
                                {{-- border-red-500 --}}
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="name"
                                type="text"
                                placeholder="Digite o nome..."
                                name="name"
                                required
                                autofocus
                            >
                        </div>

                        <div class="col-span-6">
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
                            >
                        </div>

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                                Senha
                            </label>

                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="password"
                                type="password"
                                placeholder="Digite a senha..."
                                name="password"
                                required
                            >
                        </div>

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="confirm-password">
                                Confirmar Senha
                            </label>

                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="confirm-password"
                                type="password"
                                placeholder="Digite novamente a senha..."
                                required
                            >
                        </div>

                        <div class="col-span-6">
                            <div class="grid grid-cols-5">
                                <button
                                    type="button"
                                    id="save-button"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-3 col-span-5 lg:col-span-1"
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
            function submit() {
                const nameElement = document.getElementById('name');
                const emailElement = document.getElementById('email');
                const passwordElement = document.getElementById('password');
                const confirmPasswordElement = document.getElementById('confirm-password');
                const messageContainerElement = document.getElementById('message-container');
                const messageElement = document.getElementById('message');

                const name = nameElement.value;
                const email = emailElement.value;
                const password = passwordElement.value;
                const confirmPassword = confirmPasswordElement.value;

                if (name && email && password && confirmPassword) {
                    if (password == confirmPassword) {
                        document.getElementById('create-form').submit();
                    } else {
                        messageContainerElement.removeAttribute('hidden');
                        messageElement.textContent = 'Os valores dos dois campos de senha têm que ser iguais';
                    }
                } else {
                    messageContainerElement.removeAttribute('hidden');
                    messageElement.textContent = 'Todos os campos são obrigatórios';
                }
            }

            const saveButton = document.getElementById('save-button');
            saveButton.addEventListener('click', (e) => {
                e.preventDefault();

                submit()
            });

            document.addEventListener('keydown', (e) => {
                if (e.key == 'Enter') {
                    submit();
                }
            })
        </script>
    </x-slot>
</x-app-layout>
