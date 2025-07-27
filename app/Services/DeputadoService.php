<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Jobs\DespesasDeputadoJob;
use App\Models\Deputado;

class DeputadoService
{
    public function sincronizarDeputados(){
        $response = Http::withoutVerifying()->get('https://dadosabertos.camara.leg.br/api/v2/deputados');

        $dados = $response->json()['dados'];

        foreach ($dados as $item) {
            $deputado = Deputado::updateOrCreate(
                ['id' => $item['id']],
                [
                    'nome' => $item['nome'],
                    'partido' => $item['siglaPartido'],
                    'uf' => $item['siglaUf'],
                    'uri' => $item['uri'],
                    'urlFoto' => $item['urlFoto'],
                ]
            );

            DespesasDeputadoJob::dispatch($deputado->id);
        }
    }
}
