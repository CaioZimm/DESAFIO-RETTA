<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl">
                Despesas de {{ $deputado->nome }}
            </h2>

            <div class="text-right">
                <span class="text-sm text-gray-500">Total Gasto</span>
                <p class="font-bold text-2xl text-red-600">
                    R$ {{ number_format($total_despesas, 2, ',', '.') }}
                </p>
            </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-3 lg:px-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($despesas->isEmpty())
                        <p>Nenhuma despesa encontrada para este deputado.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fornecedor</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                        <th class="py-3 px-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($despesas as $despesa)
                                        <tr>
                                            <td class="py-4 px-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($despesa->data_documento)->format('d/m/Y') }}</td>
                                            <td class="py-4 px-4">{{ $despesa->fornecedor }}</td>
                                            <td class="py-4 px-4">{{ $despesa->tipo_despesa }}</td>
                                            <td class="py-4 px-4 text-right whitespace-nowrap text-red-600 font-semibold">R$ {{ number_format($despesa->valor_documento, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $despesas->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
        
</x-app-layout>