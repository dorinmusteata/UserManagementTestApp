<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSqlCommands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_permissions', function($table)
        {
            $table->index('group_id');
            $table->index('permission_id');
        });

        Schema::table('user_groups', function($table)
        {
            $table->index('group_id');
            $table->index('user_id');
        });

        Schema::table('permissions', function($table)
        {
            $table->index('name');
        });

        Schema::table('groups', function($table)
        {
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('group_permissions', function($table)
        {
            $table->dropForeign(['group_id']);
            $table->dropForeign(['permission_id']);
            $table->dropIndex('group_permissions_group_id_index');
            $table->dropIndex('group_permissions_permission_id_index');
        });

        Schema::table('user_groups', function($table)
        {
            $table->dropForeign(['group_id']);
            $table->dropForeign(['user_id']);
            $table->dropIndex('user_groups_group_id_index');
            $table->dropIndex('user_groups_user_id_index');
        });

        Schema::table('permissions', function($table)
        {
            $table->dropIndex('permissions_name_index');
        });

        Schema::table('groups', function($table)
        {
            $table->dropIndex('groups_name_index');
        });
    }
}
