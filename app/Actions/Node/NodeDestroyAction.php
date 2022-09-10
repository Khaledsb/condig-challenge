<?php

namespace App\Actions\Node;

use App\Http\Requests\Node\DeleteNodeRequest;
use App\Models\Graph;
use App\Models\Node;
use Exception;

class NodeDestroyAction
{

    /**
     * Handle graph listing  request
     *
     * @param DeleteNodeRequest $request
     * @return Graph
     */
    public function execute(DeleteNodeRequest $request): Node
    {
        // Validate inputs
        $data = $request->validated();

        $node = Node::where('id', $data['id'])->first();

        if ($node) {
            $node->delete();
        } else {
            throw new Exception('Node already destroyed');
        }

        return  $node;
    }
}
