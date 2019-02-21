<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('users')->delete();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::table('users')->insert(array(
            0 =>
                array(
                    'id' => 16,
                    'name' => 'tester',
                    'email' => 'tester@mail.com',
                    'email_verified_at' => NULL,
                    'password' => '$2y$10$hHNipUIxOqRkAbD/G1S9yO/M.AeoUZA7Yc3xoaiYzkU4ddNpShq2W',
                    'remember_token' => NULL,
                    'created_at' => '2019-02-21 11:24:05',
                    'updated_at' => '2019-02-21 11:24:05',
                ),
        ));


    }
}
