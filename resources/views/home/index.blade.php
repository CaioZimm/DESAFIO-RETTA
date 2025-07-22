<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Deputados</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Deputados</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.sincronizar') }}" method="POST" class="mb-6">
            @csrf
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Sincronizar Deputados + Despesas
            </button>
        </form>

        <table class="w-full table-auto border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 text-left">Foto</th>
                    <th class="p-2 text-left">Nome</th>
                    <th class="p-2 text-left">Partido/UF</th>
                    <th class="p-2 text-left">Despesas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deputados as $deputado)
                    <tr class="border-t">
                        <td class="p-2">
                            <img src="{{ $deputado->urlFoto }}" alt="Foto" class="w-12 rounded-full">
                        </td>
                        <td class="p-2 font-medium">{{ $deputado->nome }}</td>
                        <td class="p-2">{{ $deputado->partido }} - {{ $deputado->uf }}</td>
                        <td class="p-2">{{ $deputado->despesas()->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $deputados->links() }}
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

</body>
</html>
