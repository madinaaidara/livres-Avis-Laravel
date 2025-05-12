<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Amaboua',
            'email' => 'amaboua2@example.com',
        ]);
    
        User::create([
            'name' => 'madina',
            'email' => 'madinaaidara@example.com',
        ]);
    
        User::create([
            'name' => 'yassine',
            'email' => 'yassine3@example.com',
        ]);
    }
}
