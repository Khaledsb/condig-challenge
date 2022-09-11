<?php

namespace App\Actions\Graph;

use App\Http\Requests\DeleteGraphRequest;
use App\Models\Graph;
use Exception;

class GraphDestroyAction
{

    /**
     * Handle graph delete  request
     *
     * @param DeleteGraphRequest $request
     * @return Graph
     */
    public function execute(DeleteGraphRequest $request): Graph
    {
        // Validate inputs
        $data = $request->validated();

        //get graph
        $graph = Graph::where('id', $data['id'])->first();

        //delete graph from graphs table if existing
        if ($graph) {
            $graph->delete();
        } else {
            throw new Exception('Graph already destroyed');
        }

        return  $graph;
    }
}
