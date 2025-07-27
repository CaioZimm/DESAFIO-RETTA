<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DeputadoService;

class SincronizarDadosDeputados extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:sincronizar-dados';

    /**
     * @var string
     */
    protected $description = 'Sincronizar os deputados e disparar o job para buscar as despesas.';

    /**
     * @var \App\Services\DeputadoService
     */
    protected $deputadoService;

    public function __construct(DeputadoService $deputadoService)
    {
        parent::__construct();
        $this->deputadoService = $deputadoService;
    }

    public function handle()
    {
        $this->deputadoService->sincronizarDeputados();
        $this->info('Sincronização de deputados iniciada...');
    }
}