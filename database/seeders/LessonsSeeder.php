<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->delete();
        DB::table('lessons')->insert([
            'name' => 'Lab - Static VLANS, Trunking, and VTP',
            'description' => 'Descripción laboratorio 1',
            'user' => 'grupo1',
            'password' => 'grupo1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('lessons')->insert([
            'name' => 'Lab - Basic RIPng and Default Gateway',
            'description' => 'Descripción laboratorio 2',
            'user' => 'grupo2',
            'password' => 'grupo2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('lessons')->insert([
            'name' => 'Lab - Securing the Router for Administrative Access',
            'description' => 'Descripción laboratorio 3',
            'user' => 'grupo3',
            'password' => 'grupo3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('lessons')->insert([
            'name' => 'Lab - Securing Administrative Access Using AAA and RADIUS',
            'description' => 'Descripción laboratorio 4',
            'user' => 'grupo4',
            'password' => 'grupo4',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
