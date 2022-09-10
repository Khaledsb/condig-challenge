<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Node extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'graph_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to date types.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Graph Relationship
     *
     * @return App\Models\Graph
     */
    public function graph()
    {
        return $this->belongsTo(Graph::class);
    }

    /**
     * child relationship
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function childs()
    {
        return $this->belongsToMany(Node::class, 'relations', 'parent_node_id', 'child_node_id');
    }

    /**
     * Parent relationship
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function parents()
    {
        return $this->belongsToMany(Node::class, 'relations' ,'child_node_id', 'parent_node_id');
    }

    public function setParent(Node $node)
    {
        return $this->parents()->attach($node);
    }

    public function setChild(Node $node)
    {
        return $this->childs()->attach($node);
    }

    /**
     * setNode function
     * @param $graph_id 
     * @return App\Models\Node
     */
    public function setGraph($graph_id)
    {
        $this->graph_id = $graph_id;
        return $this;
    }

}
