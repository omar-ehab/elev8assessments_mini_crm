<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => bcrypt('123456789'),
            'role' => 'admin',
            'created_by' => null
        ]);

        User::create([
            'name' => 'Employee',
            'email' => 'employee@app.com',
            'password' => bcrypt('123456789'),
            'role' => 'employee',
            'created_by' => null
        ]);
    }
}
