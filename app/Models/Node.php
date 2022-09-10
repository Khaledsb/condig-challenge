<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;

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
     * Graph Relationship
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function relations()
    {
        return $this->hasMany(Relation::class);
    }
}
