<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    // public function run()
    // {

    // DB::table('users')->truncate();

    // DB::table('users')->insert([
    //     [
    //         'name' => 'John Doe',
    //         'email' => 'johndoe@example.com',
    //         'password' => bcrypt('password'),
    //     ],
    //     [
    //         'name' => 'Jane Doe',
    //         'email' => 'janedoe@example.com',
    //         'password' => bcrypt('password'),
    //     ],
    // ]);
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'kenken',
            'email' => 'kenzibadrika@gmail.com',
            'password' => bcrypt('kenken12'),
        ]);
    }
}
