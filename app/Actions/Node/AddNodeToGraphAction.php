<?php

namespace App\Actions\Node;

use App\Http\Requests\Node\AddNodeToGraphRequest;
use App\Models\Graph;
use App\Models\Node;

use Exception;

class AddNodeToGraphAction
{

    /**
     * Handle node add to graph action from (api)
     * @param AddNodeToGraphRequest $request
     * @return Node
     */
    public function execute(AddNodeToGraphRequest $request): Node
    {
        // Validate inputs
        $data = $request->validated();

        $node = Node::where('id', $data['node_id'])->first();
       
        $node->setGraph($data['graph_id']);

        $node->save();
       
        return $node;

    }
}
