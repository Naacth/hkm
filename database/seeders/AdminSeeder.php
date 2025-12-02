<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'username' => 'fariz',
                'email' => 'fariz@himakom.com',
                'password' => Hash::make('fariz123'),
                'name' => 'Fariz Sandinga',
                'role' => 'superadmin',
            ],
            [
                'username' => 'admin',
                'email' => 'admin@himakom.com',
                'password' => Hash::make('admin123'),
                'name' => 'Admin HIMAKOM',
                'role' => 'admin',
            ],
        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}