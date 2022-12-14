<?php

namespace App\Actions\Graph;

use App\Http\Requests\UpdateGraphRequest;
use App\Models\Graph;

class GraphUpdateAction {

    /**
     * Handle graph update request
     *
     * @param UpdateGraphRequest $request
     * @return Graph
     */
    public function execute(UpdateGraphRequest $request) : Graph
    {
        // Validate inputs
        $data = $request->validated();

        //get current graph
        $graph = Graph::where('id', $data['id'])->firstOrFail();

        //update graph
        $graph->update($data);
        $graph->save();

        return $graph;
    }
}
