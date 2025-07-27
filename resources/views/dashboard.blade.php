<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Deputados
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-500">
                    
                    <form method="GET" class="mb-6">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Buscar por nome, partido ou UF"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full md:w-1/2">
                    </form>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($deputados as $deputado)
                            <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition">
                                <img src="{{ $deputado->urlFoto }}" alt="{{ $deputado->nome }}" class="w-24 h-24 rounded-full mx-auto mb-3">
                                <h2 class="text-xl font-semibold text-center">{{ $deputado->nome }}</h2>
                                <p class="text-center text-sm text-gray-600">{{ $deputado->partido }}/{{ $deputado->uf }}</p>
                                <p class="text-center text-gray-700 mt-1">Despesas: {{ $deputado->despesas_count }}</p>
                                <a href="{{ route('deputados.show', $deputado->id) }}"
                                   class="block text-center mt-3 text-indigo-600 hover:underline font-medium">
                                    Ver despesas
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $deputados->links() }}
                    </div>

                </div>
            </div>
</x-app-layout>