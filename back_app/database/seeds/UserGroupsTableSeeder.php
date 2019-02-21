<?php

use Illuminate\Database\Seeder;

class UserGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('user_groups')->delete();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::table('user_groups')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'user_id' => 16,
                    'group_id' => 5,
                    'created_at' => '2019-02-19 00:00:00',
                    'updated_at' => '2019-02-19 00:00:00',
                ),
            1 =>
                array(
                    'id' => 11,
                    'user_id' => 16,
                    'group_id' => 1,
                    'created_at' => '2019-02-19 00:00:00',
                    'updated_at' => '2019-02-19 00:00:00',
                ),
            2 =>
                array(
                    'id' => 12,
                    'user_id' => 16,
                    'group_id' => 2,
                    'created_at' => '2019-02-19 00:00:00',
                    'updated_at' => '2019-02-19 00:00:00',
                ),
            3 =>
                array(
                    'id' => 13,
                    'user_id' => 16,
                    'group_id' => 3,
                    'created_at' => '2019-02-19 00:00:00',
                    'updated_at' => '2019-02-19 00:00:00',
                ),
            4 =>
                array(
                    'id' => 14,
                    'user_id' => 16,
                    'group_id' => 4,
                    'created_at' => '2019-02-19 00:00:00',
                    'updated_at' => '2019-02-19 00:00:00',
                ),
            5 =>
                array(
                    'id' => 15,
                    'user_id' => 16,
                    'group_id' => 6,
                    'created_at' => '2019-02-19 00:00:00',
                    'updated_at' => '2019-02-19 00:00:00',
                ),
        ));


    }
}
