<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

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
            'name' => 'Virtual trunking Protocol',
            'description' => 'Descripción laboratorio 1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('lessons')->insert([
            'name' => 'Switch port Analyzer/ Remote Switch Port Analyzer',
            'description' => 'Descripción laboratorio 2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('lessons')->insert([
            'name' => 'First Hop Redundancy Protocols',
            'description' => 'Descripción laboratorio 3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('lessons')->insert([
            'name' => 'Dynamic Multipoint Virtual Private Network',
            'description' => 'Descripción laboratorio 4',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('lessons')->insert([
            'name' => 'Routing Redistribution',
            'description' => 'Descripción laboratorio 5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
