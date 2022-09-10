<?php

namespace App\Actions\Graph;

use App\Http\Requests\StoreGraphRequest;
use App\Models\Graph;

class GraphStoreAction
{

    /**
     * Handle graph store action from (api)
     *
     * @param StoreGraphRequest $request
     * @return Graph
     */
    public function execute(StoreGraphRequest $request): Graph
    {
        // Validate inputs
        $data = $request->validated();

        return Graph::create($data);
    }
}
