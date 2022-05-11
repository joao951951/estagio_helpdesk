<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Administrador: ') . $admin->name }}
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
                            Voltar
                        </button>
                    </form>

                    <form class="grid grid-cols-6 gap-4" action="{{ route('administradores.update', [$admin->id]) }}" method="POST" id="create-form">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="admin" value="1">

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
                                value="{{ $admin->name }}"
                                required
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
                                value="{{ $admin->email }}"
                                required
                            >
                        </div>

                        <div class="col-span-6">
                            <div class="grid grid-cols-5">
                                <button
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-3 col-span-5 lg:col-start-1 lg:col-end-2"
                                >
                                    Adicionar
                                </button>

                                <button
                                    type="button"
                                    class="bg-blue-200 hover:bg-blue-700 hover:text-white text-black font-bold py-2 px-4 rounded mb-3 col-span-5 lg:col-start-2 lg:col-end-3 lg:ml-3"
                                    onclick="changeForm();"
                                >
                                    Mudar Senha
                                </button>

                                <button
                                    type="button"
                                    class="border border-blue text-black font-bold py-2 px-4 rounded mb-3 modal-open focus:outline-white hover:bg-red-300 col-span-5 lg:col-start-5 lg:col-end-5"
                                    hidden
                                >
                                    Excluir
                                </button>
                            </div>
                        </div>
                    </form>

                    <form action="{{ route('administradores.change.password') }}" id="pass-form" method="POST">
                        @csrf

                        <input type="hidden" name="userId" id="user-id">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            function changeForm() {
                document.getElementById('user-id').value = "{{ $admin->id }}";
                document.getElementById('pass-form').submit();
            }
        </script>
    </x-slot>
</x-app-layout>
