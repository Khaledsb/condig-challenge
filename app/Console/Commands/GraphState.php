<?php

namespace App\Console\Commands;

use App\Http\Resources\GraphResource;
use App\Models\Graph;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class GraphState extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'graph:stats
                            {--gid= : Graph ID }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get graph state';

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
            'gid' => $this->option('gid'),
        ], [
            'gid' => 'required|exists:graphs,id',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $messages) {
                $this->error($messages[0]);
            }
        }else{

            $data = $validator->getData();

            $graph = Graph::with(['nodes' => function($query) {
                $query->with('childs');
                $query->with('parents');
            }])->withCount('nodes')->where('id', $data['gid'])->first();

            $res = json_encode(json_decode((new GraphResource($graph))->toJson(), true), true);

            $this->info('The commande was executed successfully.');
            $this->info('DATA:  '.$res);
            $this->info('number of nodes :  '.$graph->nodes_count);
        }
    }
}
