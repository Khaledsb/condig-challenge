<?php

namespace App\Actions\Graph;

use App\Http\Requests\DeleteGraphRequest;
use App\Models\Graph;
use Exception;

class GraphDestroyAction
{

    /**
     * Handle graph listing  request
     *
     * @param DeleteGraphRequest $request
     * @return Graph
     */
    public function execute(DeleteGraphRequest $request): Graph
    {
        // Validate inputs
        $data = $request->validated();

        $graph = Graph::where('id', $data['id'])->first();

        if ($graph) {
            $graph->delete();
        } else {
            throw new Exception('Graph already destroyed');
        }

        return  $graph;
    }
}
