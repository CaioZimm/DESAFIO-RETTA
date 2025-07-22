<?php

namespace App\Console\Commands;

use App\Services\DeputadoService;
use Illuminate\Console\Command;

class SincronizarDeputados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sincronizar-deputados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza os deputados e enfileira suas despesas';

    /**
     * Execute the console command.
     */
    public function handle(DeputadoService $deputadoService)
    {
        $this->info('Sincronizando deputados e enfileirando despesas...');
        $deputadoService->sincronizarDeputados();
        $this->info('Finalizado!');
    }
}
