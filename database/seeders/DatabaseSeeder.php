<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        
        User::factory()->create(['email' => 'admin@gmail.com', 'email_verified_at' => null, 'role_id' => 2]);
        User::factory()->create(['email' => 'user@gmail.com', 'email_verified_at' => null, 'role_id' => 1]);

        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(MemberSeeder::class);

    }
}
