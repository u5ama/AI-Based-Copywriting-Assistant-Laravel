<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_tools', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_description');
            $table->string('uri')->unique();
            $table->longText('context');
            $table->string('category');
            $table->text('icon_path')->nullable();
            $table->text('icon_path_inverse')->nullable();
            $table->enum('status',['active', 'de-active']);
            $table->string('temperature')->default('0.7');
            $table->string('max_tokens')->default('170');
            $table->string('top_p')->default('1');
            $table->string('frequency_penalty')->default('0');
            $table->string('presence_penalty')->default('0');
            $table->string('stop')->default('---');
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
        Schema::dropIfExists('content_tools');
    }
}
