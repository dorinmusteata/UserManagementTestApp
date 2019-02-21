<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        $this->call(PermissionsTableSeeder::class);

        $this->call(GroupsTableSeeder::class);
        $this->call(GroupPermissionsTableSeeder::class);

        $this->call(UserGroupsTableSeeder::class);
    }
}
