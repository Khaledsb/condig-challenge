<?php

namespace App\Actions\Graph;

use App\Http\Requests\IndexGraphRequest;
use App\Models\Graph;
use Illuminate\Support\Collection;

class GraphListingAction {

    /**
     * Handle graph index request from customer (api)
     *
     * @param IndexGraphRequest $request
     * @return Collection
     */
    public function execute(IndexGraphRequest $request) : Collection
    {
        //get all graphs with relationships
        $graphs = Graph::with(['nodes' => function($query) {
            $query->with('childs');
            $query->with('parents');
        }])->withCount('nodes')->get();

        return $graphs;
    }
}
