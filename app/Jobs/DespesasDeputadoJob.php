<?php

namespace App\Jobs;

use App\Models\Deputado;
use App\Models\Despesa;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DespesasDeputadoJob implements ShouldQueue
{
    use Queueable;

    protected int $deputadoId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $deputadoId)
    {
        $this->deputadoId = $deputadoId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        set_time_limit(300);

        $deputado = Deputado::find($this->deputadoId);

        if (!$deputado) {
            Log::warning("Deputado ID {$this->deputadoId} não encontrado.");
            return;
        }

        $url = "https://dadosabertos.camara.leg.br/api/v2/deputados/{$deputado->id}/despesas";

        do {
            $response = Http::withOptions(['verify' => false])->get($url);

            if (!$response->successful()) {
                Log::error("Erro ao buscar despesas do deputado {$deputado->id}: " . $response->status());
                return;
            }

            $dados = $response->json()['dados'];

            foreach ($dados as $item) {
                Despesa::updateOrCreate(
                    [
                        'deputado_id'     => $deputado->id,
                        'dataDocumento'   => $item['dataDocumento'],
                        'valorDocumento'  => $item['valorDocumento'],
                        'fornecedor'      => $item['nomeFornecedor'],
                    ],
                    [
                        'tipoDespesa' => $item['tipoDespesa'],
                    ]
                );

            }
            
            // Log::info("Despesa salva: ID {$despesa->id} para deputado {$deputado->nome}");

            $url = optional($response->json('links'))->firstWhere('rel', 'next')['href'] ?? null;

        } while ($url);
    }
}
