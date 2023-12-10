<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Logic to associate users with classrooms
        // Replace this with your custom logic based on your requirements
        $numberOfClassrooms = 10; // Assuming you have 10 classrooms created
        $numberOfUsers = 4; // Assuming you have 4 users created

        for ($roomID = 1; $roomID <= $numberOfClassrooms; $roomID++) {
            // Assign a user as a member of their respective classroom
            for ($userID = 1; $userID <= $numberOfUsers; $userID++) {
                DB::table('members')->insert([
                    'user_id' => $userID,
                    'room_id' => $roomID,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
