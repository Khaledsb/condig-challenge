<?php

namespace App\Actions\Node;

use App\Http\Requests\Node\AddRelationNodeRequest;
use App\Models\Node;

use Exception;
use Illuminate\Support\Facades\DB;

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

        //check if relation exists
        $res = DB::table('relations')->where('parent_node_id', $data['parent_node_id'])->where('child_node_id', $data['child_node_id'])->get();

        if (!$res->isEmpty()) throw new Exception('Relation already exists');

        $node_parent = Node::find($data['parent_node_id']);
        $node_child = Node::find($data['child_node_id']);

        //associate child and parent nodes
        $node_parent->setChild($node_child);

        return $node_parent;
    }
}
