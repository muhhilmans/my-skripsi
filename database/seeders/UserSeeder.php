<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        $users = [
            ['name' => 'Super Admin', 'email' => 'superadmin@gmail.com', 'role' => 'superadmin'],
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'role' => 'admin'],
            ['name' => 'Tutor', 'email' => 'tutor@gmail.com', 'role' => 'tutor'],
            ['name' => 'Warga Belajar', 'email' => 'wargabelajar@gmail.com', 'role' => 'wargabelajar'],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $password,
                // 'remember_token' => Str::random(10),
            ]);

            // $role = Role::where('name', $userData['role'])->first();
            $role = Role::findByName($userData['role'], 'web');
            $user->assignRole($role);
        }
    }
}
