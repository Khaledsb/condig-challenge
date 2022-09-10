<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('parent_node_id');
            $table->foreign('parent_node_id')->references('id')->on('nodes');

            $table->unsignedBigInteger('child_node_id');
            $table->foreign('child_node_id')->references('id')->on('nodes');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relations');
    }
}
