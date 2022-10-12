<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Técnico') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('funcionarios.index') }}">
                        <button class="focus:outline-white hover:bg-blue-500 hover:text-white text-black font-bold py-1 px-1 rounded mb-3 border border-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16"> 
                                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                            </svg>                            
                        </button>
                    </form>

                    <form class="grid grid-cols-6 gap-4" action="{{ route('funcionarios.store') }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Nome Completo
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

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cpf">
                                CPF
                            </label>

                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="cpf"
                                type="text"
                                placeholder="Digite o CPF..."
                                name="cpf"
                                required
                            >
                        </div>

                        {{-- Usuário de acesso --}}
                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="userName">
                                Nome do Usuário
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="userName"
                                type="text"
                                placeholder="Digite o nome do usuário..."
                                name="userName"
                                required
                            >
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="userEmail">
                                E-mail
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="userEmail"
                                type="email"
                                placeholder="Digite o e-mail..."
                                name="userEmail"
                                required
                            >
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 py-2" for="phone">
                                Contato
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="phone"
                                type="text"
                                placeholder="Digite um numero de contato..."
                                name="phone"
                                required
                            >
                        </div>

                        <div class="col-span-6 lg:col-span-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="admin">
                                Defina a permissão do técnico
                            </label>
                            
                                <div class="relative mb-3">
                                    <select
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="admin"
                                        name="admin"
                                    >
                                        <option value="" selected disabled>Selecione uma Opção</option>
                                        <option value="0">Usuário Comum</option>
                                        <option value="1">Acesso Total</option>
                                    </select>
                                </div>
                        </div>

                        <div class="col-span-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="userPassword">
                                Senha
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="userPassword"
                                type="password"
                                placeholder="Digite a senha..."
                                name="userPassword"
                                required
                            >
                        </div>

                        <div class="col-span-6">
                            <div class="grid grid-cols-5">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-3 col-span-5 lg:col-span-1">
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
        <script type="text/javascript">
            $(document).ready(function(){	
                $("#cpf").mask("999.999.999-99");
                $("#phone").mask("(99)999999999");
            });
        </script>
    </x-slot>
</x-app-layout>
