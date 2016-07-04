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
            'name' => 'sheng',
            'email' => 'engsci4shawn@gmail.com',
            'password' => bcrypt('matsumoto369'),
        ]);
        

    }
}
