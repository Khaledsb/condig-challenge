<?php

namespace App\Actions\Node;

use App\Http\Requests\Node\AddRelationNodeRequest;
use App\Models\Node;

use Exception;

class NodeAddRelationAction
{

    /**
     * Handle node add relation action from (api)
     *
     * @param AddRelationNodeRequest $request
     */
    public function execute(AddRelationNodeRequest $request)
    {
        // Validate inputs
        $data = $request->validated();

        $node_parent = Node::find($data['parent_node_id']);
        $node_child = Node::find($data['child_node_id']);

        $node_parent->setChild($node_child);
       
        return $node_parent;

    }
}
