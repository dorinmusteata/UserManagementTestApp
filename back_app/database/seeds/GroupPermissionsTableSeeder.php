<?php

use Illuminate\Database\Seeder;

class GroupPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('group_permissions')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::table('group_permissions')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'group_id' => 1,
                    'permission_id' => 8,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            1 =>
                array(
                    'id' => 2,
                    'group_id' => 1,
                    'permission_id' => 1,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            2 =>
                array(
                    'id' => 3,
                    'group_id' => 1,
                    'permission_id' => 2,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            3 =>
                array(
                    'id' => 4,
                    'group_id' => 1,
                    'permission_id' => 3,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            //
            4 =>
                array(
                    'id' => 5,
                    'group_id' => 2,
                    'permission_id' => 8,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            5 =>
                array(
                    'id' => 6,
                    'group_id' => 2,
                    'permission_id' => 1,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            6 =>
                array(
                    'id' => 7,
                    'group_id' => 2,
                    'permission_id' => 2,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            7 =>
                array(
                    'id' => 8,
                    'group_id' => 2,
                    'permission_id' => 3,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            //
            8 =>
                array(
                    'id' => 9,
                    'group_id' => 3,
                    'permission_id' => 8,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            9 =>
                array(
                    'id' => 10,
                    'group_id' => 3,
                    'permission_id' => 1,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            10 =>
                array(
                    'id' => 11,
                    'group_id' => 3,
                    'permission_id' => 2,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            11 =>
                array(
                    'id' => 12,
                    'group_id' => 3,
                    'permission_id' => 3,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            //
            12 =>
                array(
                    'id' => 13,
                    'group_id' => 4,
                    'permission_id' => 8,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            13 =>
                array(
                    'id' => 14,
                    'group_id' => 4,
                    'permission_id' => 1,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            14 =>
                array(
                    'id' => 15,
                    'group_id' => 4,
                    'permission_id' => 2,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            15 =>
                array(
                    'id' => 16,
                    'group_id' => 4,
                    'permission_id' => 3,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            //
            16 =>
                array(
                    'id' => 17,
                    'group_id' => 5,
                    'permission_id' => 8,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            17 =>
                array(
                    'id' => 18,
                    'group_id' => 5,
                    'permission_id' => 1,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            18 =>
                array(
                    'id' => 19,
                    'group_id' => 5,
                    'permission_id' => 2,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            19 =>
                array(
                    'id' => 20,
                    'group_id' => 5,
                    'permission_id' => 3,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            //
            20 =>
                array(
                    'id' => 21,
                    'group_id' => 6,
                    'permission_id' => 8,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            21 =>
                array(
                    'id' => 22,
                    'group_id' => 6,
                    'permission_id' => 1,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            22 =>
                array(
                    'id' => 23,
                    'group_id' => 6,
                    'permission_id' => 2,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            23 =>
                array(
                    'id' => 24,
                    'group_id' => 6,
                    'permission_id' => 3,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            24 =>
                array(
                    'id' => 25,
                    'group_id' => 3,
                    'permission_id' => 6,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            25 =>
                array(
                    'id' => 26,
                    'group_id' => 2,
                    'permission_id' => 7,
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
        ));
    }
}
