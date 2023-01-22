<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array([
            'name' => 'Tonny Dragon',
            'email' => 'tonny@rascan.space',
        ], [
            'name' => 'Frank Kigongi',
            'email' => 'frank@rascan.space',
        ]);

        foreach ($users as $user) {
            User::firstOrCreate([
                'email' => $user['email'],
            ], [
                'user_uid' => Str::uuid(),
                'name' => $user['name'],
                'password' => Hash::make(123456),
            ]);
        }
    }
}
