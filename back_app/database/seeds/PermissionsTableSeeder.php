<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('permissions')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::table('permissions')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'edit',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'create',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'delete',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'block',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'activate',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'user_group_append',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'permission_group_append',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'view',
                    'created_at' => '2019-02-19',
                    'updated_at' => '2019-02-19',
                ),
        ));
    }
}
