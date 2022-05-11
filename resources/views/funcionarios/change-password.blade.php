<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nova Senha') }}
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
                    <form action="{{ route('funcionarios.index') }}">
                        <button class="focus:outline-white hover:bg-blue-500 hover:text-white text-black font-bold py-1 px-1 rounded mb-3 border border-blue">
                            Voltar
                        </button>
                    </form>

                    <form class="grid grid-cols-6 gap-4" action="{{ route('funcionarios.save.password') }}" method="POST" autocomplete="off" id="edit-form">
                        @csrf

                        <input type="hidden" name="userId" value="{{ $user->id }}">

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                                Senha
                            </label>

                            <input
                                {{-- border border-red-500 --}}
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="password"
                                type="password"
                                placeholder="Digite a senha..."
                                name="password"
                                required
                                autofocus
                            >
                        </div>

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="confirm-password">
                                Confirmar Senha
                            </label>

                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
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
                                    Salvar
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
            const saveButton = document.getElementById('save-button');
            saveButton.addEventListener('click', () => {
                const passwordElement = document.getElementById('password');
                const confirmPasswordElement = document.getElementById('confirm-password');
                const messageContainerElement = document.getElementById('message-container');
                const messageElement = document.getElementById('message');

                const password = passwordElement.value;
                const confirmPassword = confirmPasswordElement.value;

                if (password && confirmPassword) {
                    if (password == confirmPassword) {
                        document.getElementById('edit-form').submit();
                    } else {
                        messageContainerElement.removeAttribute('hidden');
                        messageElement.textContent = 'Os valores dos dois campos têm que ser iguais';
                    }
                } else {
                    messageContainerElement.removeAttribute('hidden');
                    messageElement.textContent = 'Os dois campos são obrigatórios';
                }
            });
        </script>
    </x-slot>
</x-app-layout>