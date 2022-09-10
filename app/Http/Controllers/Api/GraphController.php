<?php

namespace App\Http\Controllers\Api;

use App\Actions\Graph\GraphDestroyAction;
use App\Actions\Graph\GraphListingAction;
use App\Actions\Graph\GraphShowAction;
use App\Actions\Graph\GraphStoreAction;
use App\Actions\Graph\GraphUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteGraphRequest;
use App\Http\Requests\IndexGraphRequest;
use App\Http\Requests\ShowGraphRequest;
use App\Http\Requests\StoreGraphRequest;
use App\Http\Requests\UpdateGraphRequest;
use App\Http\Resources\GraphResource;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Response;

class GraphController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexGraphRequest $request, GraphListingAction $action)
    {
        $graphs = $action->execute($request);

        return response()->json(GraphResource::collection($graphs), Response::HTTP_OK);
    }

    public function store(StoreGraphRequest $request, GraphStoreAction $action)
    {
        try {
            $graph = $action->execute($request);

            return response()->json([
                'data' => new GraphResource($graph),
                'message' => 'Graph created successfully',
            ], Response::HTTP_CREATED);
        } catch (\Exception | ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * update an existing resource in database.
     *
     * @param UpdateGraphRequest $request
     * @param GraphUpdateAction $action
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGraphRequest $request, GraphUpdateAction $action)
    {
        try {
            $graph = $action->execute($request);

            return response()->json([
                'data' => new GraphResource($graph),
                'message' => 'Graph updated successfully',
            ], Response::HTTP_OK);
        } catch (\Exception | ValidationException $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * deleting a resource in database.
     *
     * @param DeleteGraphRequest $request
     * @param GraphDestroyAction $action
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteGraphRequest $request, GraphDestroyAction $action)
    {
        try {
            $graph = $action->execute($request);

            return response()->json([
                'data' => new GraphResource($graph),
                'message' => 'Graph deleted successfully',
            ], Response::HTTP_OK);
        } catch (\Exception | ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ShowGraphRequest $request, GraphShowAction $action)
    {
        try {
            $graph = $action->execute($request);

            return response()->json([
                'data' => new GraphResource($graph),
                'message' => 'Show Graph',
            ], Response::HTTP_OK);
        } catch (\Exception | ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
