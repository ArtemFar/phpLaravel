<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            NewsSeeder::class,
        ]);

         \App\Models\User::factory(2)->create();

         \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@admin.ru',
             'password' => Hash::make('123'),
             'is_admin' => true
         ]);
    }
}

