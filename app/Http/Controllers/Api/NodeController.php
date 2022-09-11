<?php

namespace App\Http\Controllers\Api;

use App\Actions\Node\AddNodeToGraphAction;
use App\Actions\Node\NodeAddRelationAction;
use App\Actions\Node\NodeDestroyAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Node\AddNodeToGraphRequest;
use App\Http\Requests\Node\AddRelationNodeRequest;
use App\Http\Requests\Node\DeleteNodeRequest;
use App\Http\Resources\NodeResource;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Response;

class NodeController extends Controller
{
    /**
     * add relation between two nodes
     *
     * @param AddRelationNodeRequest $request
     * @param NodeAddRelationAction $action
     * @return \Illuminate\Http\Response
     */
    public function addRelation(AddRelationNodeRequest $request, NodeAddRelationAction $action)
    {
        try {
            $node = $action->execute($request);

            return response()->json([
                'data' => new NodeResource($node),
                'message' => 'Relation successfully added',
            ], Response::HTTP_CREATED);
        } catch (\Exception | ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * add node to graph
     *
     * @param AddNodeToGraphRequest $request
     * @param AddNodeToGraphAction $action
     * @return \Illuminate\Http\Response
     */
    public function addToGraph(AddNodeToGraphRequest $request, AddNodeToGraphAction $action)
    {
        try {
            $relation = $action->execute($request);

            return response()->json([
                'data' => new NodeResource($relation),
                'message' => 'Node successfully added to graph',
            ], Response::HTTP_CREATED);
        } catch (\Exception | ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * deleting a resource in database.
     *
     * @param DeleteNodeRequest $request
     * @param NodeDestroyAction $action
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteNodeRequest $request, NodeDestroyAction $action)
    {
        try {
            $node = $action->execute($request);

            return response()->json([
                'data' => new NodeResource($node),
                'message' => 'Node deleted successfully',
            ], Response::HTTP_OK);
        } catch (\Exception | ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
