@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Lista de Deputados
    </h2>
@endsection

@section('content')
    <div class="py-8 px-4 max-w-7xl mx-auto">
        <form method="GET" class="mb-6">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Buscar por nome, partido ou UF"
                class="border rounded px-4 py-2 w-full md:w-1/2">
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($deputados as $deputado)
                <div class="border rounded-lg p-4 shadow hover:shadow-md transition">
                    <img src="{{ $deputado->urlFoto }}" alt="{{ $deputado->nome }}" class="w-24 h-24 rounded-full mx-auto mb-3">
                    <h2 class="text-xl font-semibold text-center">{{ $deputado->nome }}</h2>
                    <p class="text-center text-sm text-gray-600">{{ $deputado->partido }}/{{ $deputado->uf }}</p>
                    <p class="text-center text-gray-700 mt-1">Despesas: {{ $deputado->despesas_count }}</p>
                    <a href="{{ route('deputados.show', $deputado->id) }}"
                        class="block text-center mt-3 text-purple-600 hover:underline font-medium">
                        Ver despesas
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $deputados->links() }}
        </div>
    </div>
@endsection