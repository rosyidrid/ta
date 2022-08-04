<?php

namespace Database\Seeders;

use DateTime;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 1,
            'password' => Hash::make('admin'),
        ]);

        User::create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@user.com',
            'role' => 0,
            'password' => Hash::make('user'),
        ]);
    }
}
