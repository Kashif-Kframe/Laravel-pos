<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $email = 'admin@gmail.com';
            $admin = DB::table('users')->whereEmail($email)->exists();
            if (!$admin) {
                DB::table('users')->insert([
                    'name' => "Super Admin",
                    'email' => $email,
                    'password' => Hash::make('12345678'),
                    'role' => 'Admin',
                ]);
            }
        } catch (\Exception $e) {
            echo response()->json($e->getMessage());
        }
    }
}
