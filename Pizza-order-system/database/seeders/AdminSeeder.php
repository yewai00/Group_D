<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin1',
            'email' => 'admin@gmail.com',
            'address' => 'Yangon',
            'phone' => '09123456789',
            'role' => 'admin',
            'password' => Hash::make('12345678')
        ]);
    }
}
