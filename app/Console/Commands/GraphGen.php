<?php

namespace App\Console\Commands;

use App\Models\Graph;
use App\Models\Node;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class GraphGen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'graph:gen
                            {--nbNodes= : Number of nodes }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a random graph with $nbNodes nodes';

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
        $validator = Validator::make([
            'nbNodes' => $this->option('nbNodes'),
        ], [
            'nbNodes' => 'required|integer',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $messages) {
                $this->error($messages[0]);
            }
        } else {
            $data = $validator->getData();

            $existingNodeRecords = Node::count();

            $graph = Graph::factory()->create();

            Node::factory()
                ->times($data['nbNodes'])
                ->create(['graph_id' => $graph->id])
                ->each(function ($node) use ($existingNodeRecords) {
                    $node->childs()->saveMany(
                        Node::where('id', random_int($existingNodeRecords + 1, $existingNodeRecords + 10))->get()
                    );
                });
        }
    }
}
