<?php

namespace App\Actions\Graph;

use App\Http\Requests\ShowGraphRequest;
use App\Models\Graph;
use Exception;

class GraphShowAction
{

    /**
     * Handle graph show  request
     *
     * @param ShowGraphRequest $request
     * @return Graph
     */
    public function execute(ShowGraphRequest $request): Graph
    {
        // Validate inputs
        $data = $request->validated();

        $graph = Graph::with('nodes')->where('id', $data['id'])->first();

        if (!$graph) throw new Exception('Graph not found or deleted');

        return  $graph;
    }
}
