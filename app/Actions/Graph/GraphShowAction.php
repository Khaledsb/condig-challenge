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

        //$graph = Graph::with('nodes')->withCount('nodes')->where('id', $data['id'])->first();

   
        $graph = Graph::whereHas('nodes' , function($query) {
            $query->with('childs');
            //->withCount('childs');
        })->withCount('nodes')->whereHas('nodes' , function($query) {
            $query->with('parents');
        })->where('id', $data['id'])->first();

       // dd($graph);
        if (!$graph) throw new Exception('Graph not found or deleted');

        return  $graph;
    }
}
