<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'graph_id' => $this->graph_id,
            'childs' => RelationNodeResource::collection($this->childs),
            'parents' => RelationNodeResource::collection($this->parents),
            'nb_childs' => $this->childs()->count(),
            'nb_parents' => $this->parents()->count(),
        ];
    }
}
