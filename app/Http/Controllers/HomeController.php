<?php

namespace App\Http\Controllers;

use App\Console\Commands\SincronizarDeputados;
use App\Models\Deputado;
use App\Services\DeputadoService;

class HomeController extends Controller
{
    public function index()
    {
        $deputados = Deputado::withCount('despesas')->paginate(10);
        return view('home.index', compact('deputados'));
    }

    public function sinc(DeputadoService $deputadoService)
    {
         $deputadoService->sincronizarDeputados();

    return redirect()->route('admin.deputados')->with('success', 'Sincronização iniciada com sucesso!');
    }
}
