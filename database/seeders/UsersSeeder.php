<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'Fredys Muriel',
            'email' => 'fredysmuriel@paper.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => 'aa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
