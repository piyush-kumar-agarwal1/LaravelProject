<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First create an instructor record with the correct column names
        $instructorId = DB::table('instructors')->insertGetId([
            'name_en' => 'Super Admin',
            'contact_en' => '9608536638',
            'email' => 'apiyush385@gmail.com',
            'bio' => 'Super Administrator Account',
            'role_id' => 3, // Instructor role ID
            'password' => Hash::make('123'),
            'status' => 1,
            'language' => 'en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Update your existing user to Super Admin role
        DB::table('users')
            ->where('email', 'apiyush385@gmail.com')
            ->update([
                'role_id' => 1, // Super Admin role
                'instructor_id' => $instructorId,
                'updated_at' => now(),
            ]);
    }
}