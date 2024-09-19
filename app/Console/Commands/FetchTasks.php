<?php

namespace App\Console\Commands;

use App\Business\Services\ProviderService;
use App\Facades\TaskFacade;
use Illuminate\Console\Command;

class FetchTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch tasks from providers and save to database';


    public function handle() {

        $providerService = new ProviderService();

        $providers = $providerService->getAll();

        foreach ($providers as $provider) {
            $providerService->fetchTasks($provider);
        }

        $this->info('Tasks fetched and stored successfully!');
    }

}
