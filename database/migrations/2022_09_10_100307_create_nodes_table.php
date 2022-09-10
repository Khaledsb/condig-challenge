<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('graph_id')->nullable();
            $table->foreign('graph_id')->references('id')->on('graphs');

            $table->unsignedBigInteger('parent_node')->nullable();
            $table->foreign('parent_node')->references('id')->on('nodes');

            $table->unsignedBigInteger('child_node')->nullable();
            $table->foreign('child_node')->references('id')->on('nodes');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nodes');
    }
}
