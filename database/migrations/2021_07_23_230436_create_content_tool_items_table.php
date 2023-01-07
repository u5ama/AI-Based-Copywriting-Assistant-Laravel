<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentToolItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_tool_items', function (Blueprint $table) {
            $table->id();
            $table->string('input_title');
            $table->string('input_info_text')->nullable();
            $table->string('input_info_placeholder')->nullable();
            $table->string('slug');
            $table->integer('required')->default(0);
            $table->integer('input_limit')->default(80);
            $table->text('input_options')->nullable();
            $table->enum('input_type',['input', 'select', 'multi-select', 'number', 'textarea'])->default('input');
            $table->enum('status',['active', 'de-active']);
            $table->foreignId('content_tool_id');
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
        Schema::dropIfExists('content_tool_items');
    }
}
