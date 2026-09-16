<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DBs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'phone_number' => '09111111111',
            'password' => Hash::make('12345678'),
            'role_code' => 1,
        ]);

        DB::table('users')->insert([
            'phone_number' => '09222222222',
            'password' => Hash::make('12345678'),
            'role_code' => 2,
        ]);
    }
}
