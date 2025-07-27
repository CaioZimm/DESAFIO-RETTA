<?php

namespace App\Http\Controllers;

use App\Models\Deputado;
use Illuminate\Http\Request;

class DeputadoController extends Controller
{
    public function index(Request $request){
        $query = Deputado::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nome', 'like', "%{$search}%")
                ->orWhere('partido', 'like', "%{$search}%")
                ->orWhere('uf', 'like', "%{$search}%");
        }

        $deputados = $query->withCount('despesas')->paginate(12)->withQueryString();

        return view('dashboard', compact('deputados'));
    }

    public function show($id){
        $deputado = Deputado::findOrFail($id);
        $despesas = $deputado->despesas()->orderBy('data_documento', 'desc')->paginate(20);

        $total_despesas = $deputado->despesas()->sum('valor_documento');

        return view('deputados.show', compact('deputado', 'despesas', 'total_despesas'));
    }
}
