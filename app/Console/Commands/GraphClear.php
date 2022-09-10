<?php

namespace App\Console\Commands;

use App\Models\Graph;
use Illuminate\Console\Command;

class GraphClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'graph:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all empty graphs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $graphs = Graph::wheredoesntHave('nodes')->delete();

        $this->info('Number of graphs deleted : ' .$graphs);
    }
}
