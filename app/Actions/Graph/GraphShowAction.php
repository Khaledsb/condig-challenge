<?php

namespace App\Actions\Graph;

use App\Http\Requests\ShowGraphRequest;
use App\Models\Graph;
use Exception;
use Illuminate\Support\Collection;

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

        // get graph with relationships
        $graph = Graph::with(['nodes' => function($query) {
            $query->with('childs');
            $query->with('parents');
        }])->withCount('nodes')->where('id', $data['id'])->first();

        if (!$graph) throw new Exception('Graph not found or deleted');

        return  $graph;
    }
}
