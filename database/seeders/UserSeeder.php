<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => Hash::make('password1'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'password' => Hash::make('password2'),
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice.johnson@example.com',
                'password' => Hash::make('password3'),
            ],
            [
                'name' => 'Bob Brown',
                'email' => 'bob.brown@example.com',
                'password' => Hash::make('password4'),
            ],
            [
                'name' => 'Charlie White',
                'email' => 'charlie.white@example.com',
                'password' => Hash::make('password5'),
            ],
            [
                'name' => 'Diana Green',
                'email' => 'diana.green@example.com',
                'password' => Hash::make('password6'),
            ],
            [
                'name' => 'Evan Black',
                'email' => 'evan.black@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Fiona Gray',
                'email' => 'fiona.gray@example.com',
                'password' => Hash::make('password7'),
            ],
            [
                'name' => 'George Blue',
                'email' => 'george.blue@example.com',
                'password' => Hash::make('password8'),
            ],
            [
                'name' => 'Hannah Purple',
                'email' => 'hannah.purple@example.com',
                'password' => Hash::make('password9'),
            ],
        ]);
    }
}
