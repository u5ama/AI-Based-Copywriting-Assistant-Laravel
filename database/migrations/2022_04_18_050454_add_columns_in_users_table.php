<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('users', function (Blueprint $table) {
//            $table->text('role')
//                ->after('password')
//                ->nullable();
//            $table->text('linked_user_role')
//                ->after('role')
//                ->nullable();
//            $table->text('ip_address')
//                ->after('linked_user_role')
//                ->nullable();
//            $table->text('country_name')
//                ->after('ip_address')
//                ->nullable();
//            $table->text('linkout')
//                ->after('country_name')
//                ->nullable();
//            $table->integer('member_of')
//                ->after('linkout')
//                ->nullable();
//            $table->integer('parent_member')
//                ->after('member_of')
//                ->nullable();
//            $table->integer('current_project')
//                ->after('parent_member')
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
//            $table->dropColumn('role', 'linked_user_role', 'ip_address', 'country_name', 'linkout','member_of','parent_member','current_project');
//        });
    }
}
