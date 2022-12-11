<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(10)->create();

         Group::factory()->create([
             'name' => 'generalSy',
             'type' => 'public'
         ]);

         Group::factory()->create([
             'name' => 'other',
             'type' => 'public'
         ]);

    }
}
