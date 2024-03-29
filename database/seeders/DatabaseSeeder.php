<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@user.com',
            'role' => 'admin',
            'password' => bcrypt('password')
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Approver',
            'email' => 'approver@user.com',
            'role' => 'user',
            'password' => bcrypt('password')
        ]);
    }
}
