<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->call(UsersTableSeeder::class);
        $this->command->info('users table seeded');

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->call(PostsTableSeeder::class);
        $this->command->info('posts table seeded');

        Model::reguard();
    }
}
