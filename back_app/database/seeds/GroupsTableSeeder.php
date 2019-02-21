<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('groups')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::table('groups')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'groups_admin',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'groups_permissions_admin',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'user_groups_admin',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'users_admin',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'user',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'admin',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
        ));
    }
}
