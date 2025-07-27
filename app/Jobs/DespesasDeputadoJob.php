<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use App\Models\Deputado;
use App\Models\Despesa;

class DespesasDeputadoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $deputadoId;

    public function __construct(int $deputadoId){
        $this->deputadoId = $deputadoId;
    }

    public function handle(){
        $deputado = Deputado::find($this->deputadoId);
        
        if (!$deputado){
            return;
        }

        try {
            $pagina = 1;
            do {
                $response = Http::withoutVerifying()->get("https://dadosabertos.camara.leg.br/api/v2/deputados/{$deputado->id}/despesas", [
                    'pagina' => $pagina,
                    'itens' => 100,
                ]);

                $dados = $response->json()['dados'] ?? [];
                foreach ($dados as $item) {
                    Despesa::updateOrCreate(
                        [
                            'deputado_id' => $deputado->id,
                            'data_documento' => $item['dataDocumento'],
                            'valor_documento' => $item['valorDocumento'],
                            'fornecedor' => $item['nomeFornecedor'],
                        ],
                        [
                            'tipo_despesa' => $item['tipoDespesa'],
                        ]
                    );
                }

                $pagina++;
            } while (count($dados) > 0);
        } catch (\Throwable $e) {
            Log::error("Erro ao processar despesas do deputado {$this->deputadoId}: " . $e->getMessage());
        }
    }
}
