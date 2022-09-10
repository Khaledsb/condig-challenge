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
        $graphs = Graph::with(['nodes' => function($query) {
            $query->with('childs');
        }])->with('nodes' , function($query) {
            $query->with('parents');
        })->get();

        return $graphs;
    }
}
