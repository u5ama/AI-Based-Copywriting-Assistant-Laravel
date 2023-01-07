<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('users', function (Blueprint $table) {
//            $table->text('fname')
//                ->after('name')
//                ->nullable();
//            $table->text('lname')
//                ->after('fname')
//                ->nullable();
//            $table->text('cmp_name')
//                ->after('lname')
//                ->nullable();
//            $table->text('cmp_description')
//                ->after('cmp_name')
//                ->nullable();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('users', function (Blueprint $table) {
//            $table->dropColumn('fname', 'lname', 'cmp_name', 'cmp_description');
//        });
    }
}
