<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Genres;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'root@gmail.com',
                'password' => bcrypt('admin123'),
                'role' => 1,
                'telepon' => '0895343157218',
            ],
        ];

        User::insert($users);
        $genres = ['Science Fiction', 'Fantasy', 'Romance', 'Thriller', 'Horror'];

        foreach ($genres as $genre) {
            Genres::create(['name' => $genre]);
    }
    }

}
