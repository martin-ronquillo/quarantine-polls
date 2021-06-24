<?php

namespace Database\Seeders;

// use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'ci'      => '1206855593',
            'name'      => 'Martin',
            'last_name'      => 'Ronquillo',
            'email'     => 'marticarcel@hotmail.com',
            'password'     => bcrypt('123'),
        ]);

        DB::table('users')->insert([
            'ci'      => '1206855594',
            'name'      => 'Luddy',
            'last_name'      => 'Salazar',
            'email'     => 'lulu@gmail.com',
            'password'     => bcrypt('123'),
        ]);
    }
}
