<?php

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
        DB::table('users')->insert([
            'first_name' => 'sheng',
            'email' => 'engsci4shawn@gmail.com',
            'focus' => 'DEA',
            'password' => bcrypt('matsumoto369')
        ]);
        DB::table('users')->insert([
            'first_name' => 'akira',
            'email' => 'skatejiasheng@hotmail.com',
            'focus' => 'DEG',
            'password' => bcrypt('matsumoto369')
        ]);

    }
}
