<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrailHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trail_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->unsignedInteger('trail_id')->nullable();
            $table->unsignedInteger('ads_id')->nullable();
            $table->integer('quantity')->default(0);
            $table->enum('trail_type', ['trail_quantity', 'trail_bonus'])->default('trail_quantity');
            $table->enum('status', ['active', 'in-active'])->default('active');
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
        Schema::dropIfExists('trail_histories');
    }
}
